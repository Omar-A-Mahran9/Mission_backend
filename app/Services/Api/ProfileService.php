<?php

namespace App\Services\Api;

use App\Repositories\Api\Eloquent\ProfileRepository;

class ProfileService
{
    protected $profileRepository;

    public function __construct(ProfileRepository $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    public function overView()
    {
        return $this->profileRepository->overView();
    }
    public function store($data)
    {
        $validatedData = $data->validated();
        return $this->profileRepository->update($validatedData);
    }
}
