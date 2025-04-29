<?php

namespace App\Services\Api;

use App\Repositories\Api\Eloquent\FaqRepository;
use App\Repositories\Api\Eloquent\SupportRepository;

class SupportService
{
    protected $supportRepository;

    public function __construct(SupportRepository $supportRepository)
    {
        $this->supportRepository = $supportRepository;
    }

    public function index()
    {
        return $this->supportRepository->index();
    }
    public function store($data)
    {
        $validatedData = $data->validated();
        return $this->supportRepository->store($validatedData);
    }
}
