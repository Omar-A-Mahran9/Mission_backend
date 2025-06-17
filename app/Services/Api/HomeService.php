<?php

namespace App\Services\Api;

use App\Repositories\Api\Contracts\HomeRepositoryInterface;

class HomeService
{
    protected $homeRepository;

    public function __construct(HomeRepositoryInterface $homeRepository)
    {
        $this->homeRepository = $homeRepository;
    }

    public function index()
    {
        return $this->homeRepository->index();
    }
    public function search($request)
    {
        $request->validate([
            'search' => 'nullable|string|max:255',
            'type' => 'required|in:0,1',
        ]);
        return $this->homeRepository->search($request);
    }
    public function goTosearch($request)
    {
        $request->validate([
            'type' => 'required|in:0,1',
        ]);
        return $this->homeRepository->goTosearch($request);
    }
}
