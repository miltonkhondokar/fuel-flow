<?php

namespace App\Constants;

class UserStatus
{
    public const INACTIVE = 0;
    public const ACTIVE = 1;

    public static function labels(): array
    {
        return [
            self::INACTIVE => 'Inactive',
            self::ACTIVE => 'Active',
        ];
    }

    public static function label(int $status): string
    {
        return self::labels()[$status] ?? 'Unknown';
    }
}
