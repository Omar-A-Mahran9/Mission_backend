<?php

namespace App\Repositories\Dashboard\Contracts;

interface  UserRepositoryInterface
{
    public function index($data);
    public function show($user);
}
