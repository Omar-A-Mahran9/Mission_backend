<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;

class Iban implements Rule
{
    public function passes($attribute, $value)
    {
        return preg_match('/^[A-Z]{2}[0-9]{22}$/', $value);
    }

    public function message()
    {
        return __(":attribute") . __(' must start with two uppercase letters followed by 22 digits, and contain only uppercase letters and numbers. The total length must be 24 characters.');
    }
}
