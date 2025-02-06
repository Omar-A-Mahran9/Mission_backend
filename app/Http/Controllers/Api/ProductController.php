<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Ticket;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Api\ProductResource;
use App\Http\Requests\Api\StoreRefundRequest;
use App\Http\Resources\Api\ProductListResource;
use App\Http\Resources\Api\FloatingAuctionListResource;

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
            return $query->whereDate('start_time', $today)
                ->whereTime('start_time', '>', Carbon::now());
        }, function ($query) use ($today) {
            return $query->whereDate('start_time', '>', $today);
        })->when(Auth::guard('api')->check(), function ($query) {
            return $query->whereDoesntHave('tickets', function ($subQuery) {
                $subQuery->where('user_id', Auth::guard('api')->user()->id);
            });
        })->withCount(['tickets as refunded_tickets_count' => function ($query) {
            $query->whereDoesntHave('refunds'); // Only count tickets that have refunds
        }])->paginate(8);
        // $query = DB::getQueryLog();
        return $this->successWithPagination("",  ProductListResource::collection($products)->response()->getData(true));
    }
    public function show(Product $product)
    {
        $product->loadCount('bids');
        return $this->success("Successfully", new ProductResource($product));
    }
    public function buyTicket(Request $request, Product $product)
    {
        $user = auth()->user();
        $product->loadCount('bids');
        if (now()->greaterThan($product->start_time)) {
            return $this->failure(__('The product has already started'));
        }
        $ticket = $product->tickets()->where('user_id', $user->id);
        if ($ticket->exists()) {
            return $this->failure(__('You already have a ticket for this product'));
        }
        $product->tickets()->create([
            'user_id' => $user->id,
        ]);
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

    public function auctions(Request $request)
    {
        // DB::enableQueryLog();
        $request->validate([
            'type' => ['required', Rule::in(['now', 'next'])],
        ]);
        $today = Carbon::today()->toDateString();
        $now = Carbon::now()->toTimeString(); // Get current time (HH:MM:SS)
        $user = auth()->user();
        $products = Product::with('tickets')
            ->when($request->type === 'now', function ($query) use ($today, $now) {
                return $query
                    ->whereDate('start_time', $today) // Products that start today
                    ->whereTime('start_time', '<', $now) // Start time is earlier than now
                    ->whereTime('end_time', '>=', $now); // End time is still active
            }, function ($query) use ($today) {
                return $query->whereDate('start_time', '>', $today); // Future products
            })
            ->whereHas('tickets', fn($subQuery) => $subQuery->where('user_id', $user->id)) // User must have tickets
            ->withCount(['tickets as refunded_tickets_count' => fn($query) => $query->whereDoesntHave('refunds')]) // Count non-refunded tickets
            ->paginate(8);
        // $query = DB::getQueryLog();
        return $this->successWithPagination("",  ProductListResource::collection($products)->response()->getData(true));
    }

    public function unpaidWinningProducts(Request $request)
    {
        $user = Auth::guard('api')->user();

        $products = Product::whereHas('winner', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
            ->where('is_paid', false) // Ensure payment is not completed
            ->with(['winner', 'tickets']) // Load related winner and ticket details
            ->paginate(10);

        return $this->successWithPagination("",  ProductListResource::collection($products)->response()->getData(true));
    }
}
