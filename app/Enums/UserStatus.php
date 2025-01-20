<?php

namespace App\Enums;

enum UserStatus: int
{
    case Active = 1;
    case Inactive  = 2;

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
}
