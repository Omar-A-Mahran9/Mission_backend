<?php

use App\Models\Product;
use Illuminate\Support\Facades\Broadcast;
use App\Http\Controllers\Api\ProductController;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('floating.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('auction-live.{userId}', function ($user, $userId) {
    return (int) $user->id === (int) $userId; // Ensure only the correct user gets auction updates

    // // Ensure the user has access to this product (e.g., is a participant)
    // return Product::where('id', $productId)
    //     ->whereHas('tickets', function ($query) use ($user) {
    //         $query->where('user_id', $user->id);
    //     })->exists();
});

Broadcast::channel('auction-not-live.{userId}', function ($user, $userId) {
    return (int) $user->id === (int) $userId; // Ensure only the correct user gets auction updates
});
Broadcast::channel('bid.{productId}', function ($user, $productId) {
    return true;
});
