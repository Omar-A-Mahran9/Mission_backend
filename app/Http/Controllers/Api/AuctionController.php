<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\City;
use App\Models\Address;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CityResource;
use App\Http\Resources\Api\AuctionResource;
use App\Http\Resources\Api\ProductResource;
use App\Http\Requests\Api\StoreAddressRequest;
use App\Http\Resources\Api\AddressResource;
use App\Http\Resources\Api\AuctionListResource;
use App\Http\Resources\Api\ProductListResource;
use App\Http\Resources\Api\AuctionEndedListResource;

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
                return $query->whereTime('start_time', '>', $now)->whereDate('end_time', '>', $today); // End time is still active
            })
            ->whereHas('tickets', fn($subQuery) => $subQuery->where('user_id', $user->id)) // User must have tickets
            ->withCount(['tickets as refunded_tickets_count' => fn($query) => $query->whereDoesntHave('refunds')]) // Count non-refunded tickets
            ->paginate(8);
        return $this->successWithPagination("",  ProductListResource::collection($products)->response()->getData(true));
    }

    public function auction(Product $product)
    {
        $product->loadCount([
            'bids',
            'images'
        ]);
        $product->participants_count = $product->bids()
            ->distinct()
            ->count('user_id');
        $product->highest_rank = $this->getHighestBids($product);
        return $this->success("",  new AuctionResource($product));
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

    public function cities()
    {
        $cities = City::paginate(perPage: 50);
        return $this->successWithPagination("", CityResource::collection($cities)->response()->getData(true));
    }

    public function pay(Product $product)
    {
        $product->loadCount([
            'bids',
            'images'
        ]);
        $userId = auth()->id();
        // Retrieve the winner record once
        $winner = $product->winner()->where('user_id', $userId)->first();

        // Validate if the user is actually the winner
        if (!$winner) {
            return $this->failure("You have not won this product");
        }

        // Check if the product is already purchased
        if ($winner->is_bought) {
            return $this->failure("You have already bought this product");
        }
        $winner->update([
            'is_bought' => true,
            'paid_at' => now(),
        ]);

        // Load required counts
        $product->loadCount(['bids', 'images']);

        // Count unique participants
        $product->participants_count = $product->bids()->distinct()->count('user_id');

        // Get highest bids per unique user
        $product->highest_rank = $this->getHighestBids($product);
        return $this->success("", new AuctionResource($product));
    }

    /**
     * Get highest bids per unique user.
     */
    private function getHighestBids(Product $product)
    {
        return $product->bids()
            ->whereIn('id', function ($query) use ($product) {
                $query->selectRaw('MAX(id)')
                    ->from('bids')
                    ->where('product_id', $product->id)
                    ->groupBy('user_id'); // Ensures unique user_id
            })
            ->with('user')
            ->orderByDesc('bid_amount')
            ->limit(5)
            ->get();
    }
}
