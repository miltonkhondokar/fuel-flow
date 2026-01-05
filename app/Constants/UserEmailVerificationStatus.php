<?php

namespace App\Constants;

class UserEmailVerificationStatus
{
    public const UNVERIFIED = 0;
    public const VERIFIED = 1;

    public static function labels(): array
    {
        return [
            self::UNVERIFIED => 'Unverified',
            self::VERIFIED => 'Verified',
        ];
    }

    public static function label(int $status): string
    {
        return self::labels()[$status] ?? 'Unknown';
    }
}
