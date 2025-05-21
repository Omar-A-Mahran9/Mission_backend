<?php

namespace App\Services\Api;

use App\Repositories\Api\Contracts\BannerRepositoryInterface;

class BannerService
{
    protected $bannerRepository;

    public function __construct(BannerRepositoryInterface $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;
    }

    public function index()
    {
        return $this->bannerRepository->index();
    }
}
