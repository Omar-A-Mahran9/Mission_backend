<?php

use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('floating.user.{id}', function ($user, $id) {
    return $user->id == $id;
});
