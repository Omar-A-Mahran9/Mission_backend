<?php

namespace App\Repositories\Api\Eloquent;

use App\Models\Banner;
use App\Repositories\Api\Contracts\BannerRepositoryInterface;

class BannerRepository implements BannerRepositoryInterface
{
    public function index()
    {
        return Banner::get();
    }
}
