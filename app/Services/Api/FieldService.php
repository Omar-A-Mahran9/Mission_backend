<?php

namespace App\Services\Api;

use App\Repositories\Api\Eloquent\FieldRepository;

class FieldService
{
    protected $fieldRepository;

    public function __construct(FieldRepository $fieldRepository)
    {
        $this->fieldRepository = $fieldRepository;
    }

    public function index()
    {
        return $this->fieldRepository->index();
    }
}
