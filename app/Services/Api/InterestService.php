<?php

namespace App\Services\Api;

use App\Repositories\Api\Eloquent\InterestRepository;

class InterestService
{
    protected $interestRepository;

    public function __construct(InterestRepository $interestRepository)
    {
        $this->interestRepository = $interestRepository;
    }

    public function index()
    {
        return $this->interestRepository->index();
    }
}
