<?php

namespace App\Repositories\Api\Contracts;

interface  FieldRepositoryInterface
{
    public function index($request);
    public function fieldSkils();
    public function update($request);
}
