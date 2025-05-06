<?php

namespace App\Services\Api;

 use App\Repositories\Api\Eloquent\TipRepository;

class TipService
{
    protected $tipRepository;

    public function __construct(TipRepository $tipRepository)
    {
        $this->tipRepository = $tipRepository;
    }

    public function index()
    {
        return $this->tipRepository->index();
    }
}
