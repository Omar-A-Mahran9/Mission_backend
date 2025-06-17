<?php

namespace App\Repositories\Api\Contracts;

interface HomeRepositoryInterface
{
    public function index();
    public function search($request);
    public function goTosearch($request);
}
