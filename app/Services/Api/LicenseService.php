<?php

namespace App\Services\Api;


use App\Repositories\Api\Eloquent\LicenseRepository;

class LicenseService
{
    protected $licenseRepository;


    public function __construct(LicenseRepository $licenseRepository)
    {
        $this->licenseRepository = $licenseRepository;
    }

    public function index()
    {
        return $this->licenseRepository->index();
    }

    public function store($data)
    {
        $validatedData = $data->validated();
        return $this->licenseRepository->store($validatedData);
    }

    public function update($data, $id)
    {
        $validatedData = $data->validated();
        return $this->licenseRepository->update($validatedData, $id);
    }
    public function destroy($id)
    {
        return $this->licenseRepository->destroy($id);
    }
}
