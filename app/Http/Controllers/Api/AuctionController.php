<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\City;
use App\Models\Address;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Events\BidPlacedEvent;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Events\AuctionLiveDetailEvent;
use App\Http\Resources\Api\CityResource;
use App\Http\Resources\Api\AddressResource;
use App\Http\Resources\Api\AuctionResource;
use App\Http\Resources\Api\ProductResource;
use App\Http\Requests\Api\StoreAddressRequest;
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
    public function auctionsNow(Request $request)
    {
        $today = Carbon::today()->toDateString();
        $now = Carbon::now()->toTimeString(); // Get current time (HH:MM:SS)
        $user = auth()->user();
        $products = Product::with('tickets')
            ->whereDate('start_time', $today) // Products that start today
            ->whereTime('start_time', '<', $now) // Start time is earlier than now
            ->whereTime('end_time', '>=', $now) // End time is still active
            ->whereHas('tickets', fn($subQuery) => $subQuery->where('user_id', $user->id)) // User must have tickets
            ->withCount(['tickets as refunded_tickets_count' => fn($query) => $query->whereDoesntHave('refunds')]) // Count non-refunded tickets
            ->paginate(8);

        // Process bids efficiently
        $products->transform(function ($product) {
            $product->highest_rank = $this->getHighestBids($product);
            $product->bid_amount = $this->placeBid($product);
            return $product;
        });
        return $this->successWithPagination("",  AuctionResource::collection($products)->response()->getData(true));
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
        $product->bid_amount = $this->placeBid($product);
        return $this->success("",  new AuctionResource($product));
    }


    public function bid(Request $request, Product $product)
    {
        // dd(now());
        $user = auth()->user();
        return DB::transaction(function () use ($product, $user) {
            // Lock the product to prevent race conditions
            $product = Product::where('id', $product->id)->lockForUpdate()->first();

            // Load necessary relationships
            $product->load('productBiddings', 'bids')->loadCount('bids');

            // Validate auction status
            if (now()->lessThan($product->start_time)) {
                return $this->failure(__('The product has not started yet'));
            }
            if (now()->greaterThan($product->end_time)) {
                return $this->failure(__('The product has already ended'));
            }

            // Ensure user has a ticket
            if (!$product->tickets()->where('user_id', $user->id)->exists()) {
                return $this->failure(__('You do not have a ticket for this product'));
            }

            // Prevent duplicate consecutive bids by the same user
            $latestBid = $product->bids()->latest()->first();
            if ($latestBid && $latestBid->user_id === $user->id) {
                return $this->failure(__('You have already placed a bid for this product'));
            }

            // Adjust auction end time if needed
            $this->adjustEndTime($product);

            // Place the bid
            $product->bids()->create([
                'user_id' => $user->id,
                'bid_amount' => $this->placeBid($product),
            ]);

            // Count unique participants
            $product->participants_count = $product->bids()->distinct()->count('user_id');

            // Get highest bids per unique user
            $product->highest_rank = $this->getHighestBids($product);
            $product->bid_amount = $this->placeBid($product);

            // Broadcast bid event
            broadcast(new BidPlacedEvent($product));

            return $this->success("Successfully", new AuctionResource($product));
        });
    }


    public function endedAuctions()
    {
        $user = auth()->user();
        $auctions = Product::with(['winners' => function ($query) {
            $query->where('is_bought', true)->with('user', 'bid'); // Only load winners where is_bought = true
        }])->where('end_time', '<', now()) // Ensure auction has ended
            ->whereDoesntHave('tickets', function ($query) use ($user) {
                $query->where('user_id', $user->id)->whereDoesntHave('refunds'); // Exclude auctions where the user placed a bid
            })
            ->orderByDesc('end_time') // Show latest ended auctions first
            ->paginate(10);
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
        $winner = $product->winners()->where('user_id', $userId)->first();

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

    public static  function placeBid(Product $product)
    {
        $productPrice = sanitizeNumber($product->product_price);
        $currentPrice =  sanitizeNumber($product->bids()->latest()->first()?->bid_amount ?? $product->start_price);
        $bidPrice = $product->bids()->exists() ? $product->bid_price : 0;
        $totalComparePercentage = ($currentPrice / $productPrice) * 100;
        if (($product->bids()->exists()) && ($totalComparePercentage >= $product->productBiddings()->min('bidding_discount_percentage'))) {
            $finalPercentage = $product->productBiddings()->where('bidding_discount_percentage', '<=', $totalComparePercentage)->first();
            $bidPrice = ($bidPrice * $finalPercentage->final_bidding_percentage) / 100;
        }
        return $currentPrice + $bidPrice;
    }
    public function adjustEndTime(Product $product)
    {
        $now = Carbon::now();
        $endTime = Carbon::parse($product->end_time);
        $remainingSeconds = $endTime->diffInSeconds($now, true); // Get remaining time in seconds
        if (($remainingSeconds > 0 && $remainingSeconds < 119) && $now->LessThanOrEqualTo($endTime)) {
            $additionalSeconds = 120 - $remainingSeconds;
            $newEndTime = $endTime->addSeconds($additionalSeconds);
            $product->end_time = $newEndTime;
            $product->save(); // Save updated end_time in the database
        }
        return $product->end_time; // Return the updated end time
    }

    public function storeWinner(Product $product)
    {
        $product->load(['bids' => function ($query) {
            $query->latest()->limit(1);
        }, 'winners']);

        $latestBid = $product->bids->first();

        if (!$latestBid) {
            return $this->failure(__('No bids found for this product'));
        }

        if (Carbon::now()->lessThan($product->end_time)) {
            return $this->failure(__('The auction is still active. No winner can be stored yet.'));
        }

        if ($product->winners->isNotEmpty()) {
            return $this->failure(__('A winner has already been selected for this auction'));
        }

        if ($product->winners->where('user_id', $latestBid->user_id)->isNotEmpty()) {
            return $this->failure(__('User has already won this auction'));
        }
        $product->winners()->create([
            'user_id' => $latestBid->user_id,
            'bid_id' => $latestBid->id,
            'is_bought' => false,
        ]);
        return $this->success("", new AuctionResource($product));
    }
}
