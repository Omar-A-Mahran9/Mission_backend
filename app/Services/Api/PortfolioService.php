<?php

namespace App\Services\Api;


use App\Repositories\Api\Eloquent\LicenseRepository;
use App\Repositories\Api\Eloquent\PortfolioRepository;

class PortfolioService
{
    protected $portfolioRepository;


    public function __construct(PortfolioRepository $portfolioRepository)
    {
        $this->portfolioRepository = $portfolioRepository;
    }

    public function index()
    {
        return $this->portfolioRepository->index();
    }

    public function store($data)
    {
        $validatedData = $data->validated();
        return $this->portfolioRepository->store($validatedData);
    }

    public function update($data, $id)
    {
        $validatedData = $data->validated();
        return $this->portfolioRepository->update($validatedData, $id);
    }
    public function destroy($id)
    {
        return $this->portfolioRepository->destroy($id);
    }
}
