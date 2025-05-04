<?php

namespace App\Services\Api;

use App\Repositories\Api\Eloquent\ExcperiencRepository;
use App\Repositories\Api\Eloquent\CertificateRepository;

class CertificateService
{
    protected $certificateRepository;


    public function __construct(CertificateRepository $certificateRepository)
    {
        $this->certificateRepository = $certificateRepository;
    }

    public function index()
    {
        return $this->certificateRepository->index();
    }

    public function store($data)
    {
        $validatedData = $data->validated();
        return $this->certificateRepository->store($validatedData);
    }

    public function update($data, $id)
    {
        $validatedData = $data->validated();
        return $this->certificateRepository->update($validatedData, $id);
    }
    public function destroy($id)
    {
        return $this->certificateRepository->destroy($id);
    }
}
