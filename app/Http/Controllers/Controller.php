<?php

namespace App\Http\Controllers;

use App\Traits\RespondsWithHttpStatus;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller
{
    use AuthorizesRequests, ValidatesRequests, RespondsWithHttpStatus;

}
