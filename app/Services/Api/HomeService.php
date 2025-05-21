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
}
