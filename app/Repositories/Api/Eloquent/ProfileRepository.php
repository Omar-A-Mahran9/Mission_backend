<?php

namespace App\Repositories\Api\Eloquent;


use App\Models\Interest;
use App\Models\SupportMessage;
use App\Models\User;
use App\Repositories\Api\Contracts\ProfileRepositoryInterface;

class ProfileRepository implements ProfileRepositoryInterface
{

    public function overView()
    {
        $user = auth()->user();
        if ($user) {
            return $user;
        }
    }
    public function update($data)
    {
        $user = auth()->user();
        if ($user) {
            $user->update($data);
            return $user;
        }
    }
}
