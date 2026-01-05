<?php

namespace App\Constants;

class Gender
{
    public const MALE = 1;
    public const FEMALE = 2;

    public static function labels(): array
    {
        return [
            self::MALE => 'Male',
            self::FEMALE => 'Female',
        ];
    }

    public static function label(int $gender): string
    {
        return self::labels()[$gender] ?? 'Unknown';
    }

    public static function values(): array
    {
        return array_keys(self::labels());
    }
}
