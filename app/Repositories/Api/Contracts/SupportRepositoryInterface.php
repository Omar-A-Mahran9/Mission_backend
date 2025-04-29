<?php

namespace App\Repositories\Api\Contracts;

interface SupportRepositoryInterface
{
    public function index();
    public function store($data);
}
