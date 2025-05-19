<?php

namespace App\Services\Api;

use App\Repositories\Api\Contracts\FieldRepositoryInterface;

class FieldService
{
    protected $fieldRepository;

    public function __construct(FieldRepositoryInterface $fieldRepository)
    {
        $this->fieldRepository = $fieldRepository;
    }

    public function index($request)
    {
        return $this->fieldRepository->index($request);
    }

    public function fieldSkils()
    {
        return $this->fieldRepository->fieldSkils();
    }
    public function update($request)
    {
        $validatedData = $request->validated();
        return $this->fieldRepository->update($validatedData);
    }
}
