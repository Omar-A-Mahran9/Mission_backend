<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpdatePasswordRequest;
use App\Http\Requests\Api\UpdateProfileRequest;
use App\Http\Resources\Api\UserResource;
use Illuminate\Http\Request;

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
        $user = auth()->user()->update($data);
        return $this->success("Successfully", new UserResource($user));
    }
    public function updatePassword(UpdatePasswordRequest $request)
    {
        $data['password'] = $request->validated()['password'];
        auth()->user()->update($data);
        return $this->success("Updated Successfully", []);
    }
}
