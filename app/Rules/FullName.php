<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;

class FullName implements Rule
{
    public function passes($attribute, $value)
    {
        return preg_match('/^[\p{Arabic}a-zA-Z]+\s+[\p{Arabic}a-zA-Z\s]+$/u', $value);
    }

    public function message()
    {
        return __(":attribute") . __(' enter your full name, which consists of your first and last name');
    }
}
