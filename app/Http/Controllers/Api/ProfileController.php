<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\UserResource;
use App\Http\Requests\Api\UpdateProfileRequest;
use App\Http\Requests\Api\UpdatePasswordRequest;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = auth()->user();
        return $this->success("Successfully", new UserResource($user));
    }
    public function updateProfile(UpdateProfileRequest $request)
    {
        $data = $request->validated();
        $user = auth()->user();

        DB::transaction(function () use ($user, $data) {
            $user->update($data);
        });
        return $this->success("Successfully", new UserResource($user));
    }
    public function updatePassword(UpdatePasswordRequest $request)
    {
        $data['password'] = $request->validated()['password'];
        auth()->user()->update($data);
        return $this->success("Updated Successfully", []);
    }
}
