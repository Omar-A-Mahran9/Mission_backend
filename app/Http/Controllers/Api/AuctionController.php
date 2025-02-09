<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\AuctionEndedListResource;
use App\Http\Resources\Api\ProductResource;
use App\Http\Resources\Api\ProductListResource;

class AuctionController extends Controller
{
    public function auctions(Request $request)
    {
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
            }, function ($query) use ($today, $now) {
                return $query->whereTime('start_time', '>', $now); // End time is still active
            })
            ->whereHas('tickets', fn($subQuery) => $subQuery->where('user_id', $user->id)) // User must have tickets
            ->withCount(['tickets as refunded_tickets_count' => fn($query) => $query->whereDoesntHave('refunds')]) // Count non-refunded tickets
            ->paginate(8);
        return $this->successWithPagination("",  ProductListResource::collection($products)->response()->getData(true));
    }
    public function bid(Request $request, Product $product)
    {
        $user = auth()->user();
        $product->loadCount('bids');
        if (now()->greaterThan($product->end_time)) {
            return $this->failure(__('The product has already ended'));
        }
        $ticket = $product->tickets()->where('user_id', $user->id);
        if (!$ticket->exists()) {
            return $this->failure(__('You do not have a ticket for this product'));
        }
        if (optional($product->bids()->latest()->first())->user_id === $user->id) {
            return $this->failure(__('You have already placed a bid for this product'));
        }
        $product->bids()->create([
            'user_id' => $user->id,
            'bid_amount' => optional($product->bids()->latest()->first())->bid_amount
                ? optional($product->bids()->latest()->first())->bid_amount + 100
                : $product->start_price,
        ]);
        return $this->success("Successfully", new ProductResource($product));
    }

    public function endedAuctions()
    {
        $user = auth()->user();
        $auctions = Product::with(['winner.user', 'winner.bid'])->where('end_time', '<', now()) // Ensure auction has ended
            ->whereDoesntHave('tickets', function ($query) use ($user) {
                $query->where('user_id', $user->id)->whereDoesntHave('refunds'); // Exclude auctions where the user placed a bid
            })
            ->orderByDesc('end_time') // Show latest ended auctions first
            ->paginate(10);
        // dd($auctions);
        return $this->successWithPagination("",  AuctionEndedListResource::collection($auctions)->response()->getData(true));
    }
}