<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function supportData()
    {
        return $this->success("Successfully", ['phone' => setting('phone'), 'email' => setting('email'), 'address' => setting('address')]);
    }
}