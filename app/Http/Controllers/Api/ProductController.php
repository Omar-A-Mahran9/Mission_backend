<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Bid;
use App\Models\Ticket;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Events\AuctionLiveEvent;
use App\Events\AucationTodayEvent;
use App\Events\AuctionDetailEvent;
use App\Events\AuctionNotLiveEvent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Events\AucationNotTodayEvent;
use App\Services\BroadcastingService;
use App\Http\Resources\Api\ProductResource;
use App\Http\Requests\Api\StoreRefundRequest;
use App\Http\Resources\Api\ProductListResource;
use App\Http\Resources\Api\FloatingAuctionListResource;
use App\Http\Resources\Api\ProductUnPaidWinListResource;

class ProductController extends Controller
{
    protected $broadcastingService;

    public function __construct(BroadcastingService $broadcastingService)
    {
        $this->broadcastingService = $broadcastingService;
    }
    public function index(Request $request)
    {
        // DB::enableQueryLog();
        $request->validate([
            'type' => ['required', Rule::in(['today', 'next'])],
        ]);
        $today = Carbon::today()->toDateString();
        $products = Product::with('tickets')->when($request->type === 'today', function ($query) use ($today) {
            return $query->whereDate('start_time', $today);
            // ->whereTime('start_time', '>', Carbon::now());
        }, function ($query) use ($today) {
            return $query->whereDate('start_time', '>', $today);
        })->when(Auth::guard('api')->check(), function ($query) {
            return $query->whereDoesntHave('tickets', function ($subQuery) {
                $subQuery->where('user_id', Auth::guard('api')->user()->id);
            });
        })->withCount(['tickets as refunded_tickets_count' => function ($query) {
            $query->whereDoesntHave('refunds'); // Only count tickets that have refunds
        }]);
        return $this->successWithPagination("",  ProductListResource::collection($products->paginate(8))->response()->getData(true));
    }
    public function show(Product $product)
    {
        $product->loadCount([
            'tickets as refunded_tickets_count' => fn($query) => $query->whereDoesntHave('refunds'),
            'bids'
        ]);
        $product->participants_count = $product->bids()
            ->distinct()
            ->count('user_id');
        $product->highest_rank = $product->bids()->whereIn('id', function ($query) use ($product) {
            $query->selectRaw('MAX(id)')
                ->from('bids')
                ->where('product_id', $product->id)
                ->groupBy('user_id'); // Ensures unique user_id
        })->with('user')
            ->orderByDesc('bid_amount')->limit(5)->get();
        return $this->success("Successfully", new ProductResource($product));
    }
    public function buyTicket(Request $request, Product $product)
    {
        $user = auth()->user();
        $product->loadCount('bids',);
        // if (now()->greaterThan($product->start_time)) {
        //     return $this->failure(__('The product has already started'));
        // }
        // $ticket = $product->tickets()->where('user_id', $user->id);
        // if ($ticket->exists()) {
        //     return $this->failure(__('You already have a ticket for this product'));
        // }
        // $product->tickets()->create([
        //     'user_id' => $user->id,
        // ]);
        $this->auctionEvent($product);
        return $this->success("Successfully", new ProductResource($product));
    }
    public function refund(StoreRefundRequest $request, Product $product)
    {
        $data = $request->validated();
        // Find the user's ticket for this product
        $product = Product::where('id', $product->id)
            ->whereHas('tickets', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->with('tickets.refunds')
            ->first();
        // If no ticket found, return an error
        if (!$product) {
            return $this->failure(__('No ticket found for this product'));
        }
        // Check if the ticket already has a refund
        if ($product->refunds()->where('user_id', auth()->user()->id)->exists()) {
            return $this->failure(__('Refund already exists for this ticket'));
        }
        $product->refunds()->create([
            'user_id' => auth()->user()->id,
            'ticket_id' => $product->tickets->first()->id,
            'reason' => $data['reason'],
        ]);
        return $this->success("Successfully", []);
    }
    public function floatingAuctions()
    {
        $today = Carbon::today()->toDateString(); // Get today's date (YYYY-MM-DD)
        $now = Carbon::now()->toTimeString(); // Get current time (HH:MM:SS)
        $user = auth()->user();
        $products = Product::whereDate('start_time', $today) // Check if date matches today
            ->whereTime('start_time', '<', $now)->whereTime('end_time', '>=', $now)->whereHas('tickets', function ($query) use ($user) {
                $query->where('user_id', $user->id); // Only tickets that belong to this user
            })->get();
        return $this->success("Successfully",  FloatingAuctionListResource::collection($products));
    }

    public function unpaidWinningProducts(Request $request)
    {
        $user = auth()->user();

        $products = Product::whereHas('winners', function ($query) use ($user) {
            $query->with('bid')->where('user_id', $user->id)
                ->where('is_bought', false);
        })
            ->paginate(8);

        return $this->successWithPagination("",  ProductUnPaidWinListResource::collection($products)->response()->getData(true));
    }

    public function auctionEvent(Product $product)
    {
        $today = Carbon::today();
        $now = Carbon::now();
        $startTime = Carbon::parse($product->start_time);
        $user = auth()->user();

        // Load all necessary relationships and counts in one query
        $product->load([
            'tickets' => fn($query) => $query->where('user_id', $user->id)->whereDoesntHave('refunds'),
        ])->loadCount([
            'bids',
            'tickets as refunded_tickets_count' => fn($query) => $query->whereDoesntHave('refunds')
        ]);

        // Broadcast auction details (always)
        broadcast(new AuctionDetailEvent($product->id, $product));

        // Check if the user has a valid ticket (No need for multiple `whereHas` calls)
        $hasValidTicket = $product->tickets->isNotEmpty();

        // Determine auction status and broadcast accordingly
        if ($hasValidTicket) {
            if ($startTime->isToday() && $startTime->lessThan($now) && Carbon::parse($product->end_time)->greaterThanOrEqualTo($now)) {
                broadcast(new AuctionLiveEvent($product));
            } elseif ($startTime->greaterThan($now)) {
                broadcast(new AuctionNotLiveEvent($product));
            }
        }

        // Broadcast auction date-related events
        if ($startTime->isToday()) {
            $countToday = Product::whereDate('start_time', $today)->count();
            broadcast(new AucationTodayEvent($product, $countToday));
        } elseif ($startTime->greaterThan($today)) {
            $countNotToday = Product::whereDate('start_time', '>', $today)->count();
            broadcast(new AucationNotTodayEvent($product, $countNotToday));
        }
    }
}
