<?php

namespace App\Repositories\Api\Eloquent;


use App\Models\Interest;
use App\Models\SupportMessage;
use App\Repositories\Api\Contracts\SupportRepositoryInterface;

class SupportRepository implements SupportRepositoryInterface
{

    public function index()
    {
        $support = [
            "address" => setting('address'),
            "email" => setting('email'),
            "phone" => setting('phone'),
        ];
        return $support;
    }
    public function store($data)
    {
        return SupportMessage::create($data);
    }
}
