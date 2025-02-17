<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Events\FloatingEvent;
use App\Events\AuctionLiveEvent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class BroadcastingService
{
    /**
     * Broadcast floating auctions to a specific user.
     */
    public function broadcastFloatingAuctions()
    {
        $today = Carbon::today()->toDateString(); // Get today's date (YYYY-MM-DD)
        $now = Carbon::now()->toTimeString(); // Get current time (HH:MM:SS)
        $user = Auth::guard('api')->user();
        $products = Product::whereDate('start_time', $today) // Check if date matches today
            ->whereTime('start_time', '<', $now)->whereTime('end_time', '>=', $now)->whereHas('tickets', function ($query) use ($user) {
                $query->where('user_id', $user->id); // Only tickets that belong to this user
            })->get();
        if ($products) {
            broadcast(new FloatingEvent($products, auth()->id()));
            Log::info("Broadcasted FloatingEvent for user");
        }
        Log::info("No floating auctions found for user");
    }
    public function unpaidWinningProducts(Request $request)
    {
        $user = Auth::guard('api')->user();

        $products = Product::whereHas('winners', function ($query) use ($user) {
            $query->with('bid')->where('user_id', $user->id)
                ->where('is_bought', false);
        })
            ->paginate(8);
    }

    public function auctionsLive($product)
    {
        $today = Carbon::today()->toDateString();
        $now = Carbon::now()->toTimeString(); // Get current time (HH:MM:SS)
        $user = auth()->user();
        $isLive  = Product::with('tickets')->where('id', $product->id)->where(function ($query) use ($today, $now) {
            $query
                ->whereDate('start_time', $today) // Products that start today
                ->whereTime('start_time', '<', $now) // Start time is earlier than now
                ->whereTime('end_time', '>=', $now); // End time is still active
        })->whereHas('tickets', fn($subQuery) => $subQuery->where('user_id', $user->id)) // User must have tickets
            ->withCount(['tickets as refunded_tickets_count' => fn($query) => $query->whereDoesntHave('refunds')]) // Count non-refunded tickets
            ->exists();
        if ($isLive) {
            broadcast(new AuctionLiveEvent($product->id, $product));
        }
    }
}
