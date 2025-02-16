<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Bid;
use App\Models\Ticket;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Events\AucationEvent;
use App\Events\FloatingEvent;
use Illuminate\Validation\Rule;
use App\Events\AucationTodayEvent;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Events\AucationNotTodayEvent;
use App\Http\Resources\Api\ProductResource;
use App\Http\Requests\Api\StoreRefundRequest;
use App\Http\Resources\Api\ProductListResource;
use App\Http\Resources\Api\FloatingAuctionListResource;
use App\Http\Resources\Api\ProductUnPaidWinListResource;

class ProductController extends Controller
{
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
        // dd($products->count());
        // $query = DB::getQueryLog();
        // event(new AucationEvent(ProductListResource::collection($products)->response()->getData(true)));
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
        // $product->loadCount('bids');
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
        broadcast(new FloatingEvent($products, auth()->id()));
        return $this->success("Successfully",  FloatingAuctionListResource::collection($products));
    }

    public function unpaidWinningProducts(Request $request)
    {
        $user = auth()->user();

        $products = Product::whereHas('winners', function ($query) use ($user) {
            $query->with('bid')->where('user_id', $user->id)
                ->where('is_bought', false);
        })
            // ->with(['winners.bid']) // Ensure 'bid' is a relationship in the 'Winner' model
            ->paginate(8);

        return $this->successWithPagination("",  ProductUnPaidWinListResource::collection($products)->response()->getData(true));
    }

    public function auctionEvent($product)
    {
        $countProduct = Product::query();
        if (Carbon::parse($product->start_time)->isToday()) {
            $countToday = $countProduct->whereDate('start_time', Carbon::today())->count();
            broadcast(new AucationTodayEvent($product, $countToday));
        } else {
            $countNotToday = $countProduct->whereDate('start_time', '>', Carbon::today())->count();
            broadcast(new AucationNotTodayEvent($product, $countNotToday));
        }
    }
}
