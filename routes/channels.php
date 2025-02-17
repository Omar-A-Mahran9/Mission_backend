<?php

use App\Models\Product;
use Illuminate\Support\Facades\Broadcast;
use App\Http\Controllers\Api\ProductController;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('floating.user.{id}', function ($user, $id) {
    return $user->id == $id;
});

Broadcast::channel('auction-live.{productId}', function ($user, $productId) {
    // Ensure the user has access to this product (e.g., is a participant)
    return Product::where('id', $productId)
        ->whereHas('tickets', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->exists();
});
