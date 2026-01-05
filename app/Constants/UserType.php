<?php

namespace App\Constants;

class UserType
{
    public const ADMIN = 'Admin';
    public const EXECUTIVE = 'Executive';
    public const PUMP_MANAGER = 'Pump Manager';

    /**
     * All roles
     */
    public static function all(): array
    {
        return [
            self::ADMIN,
            self::EXECUTIVE,
            self::PUMP_MANAGER,
        ];
    }

    /**
     * Role labels for UI
     */
    public static function labels(): array
    {
        return [
            self::ADMIN => 'Admin',
            self::EXECUTIVE => 'Executive',
            self::PUMP_MANAGER => 'Pump Manager',
        ];
    }

    /**
     * Get label
     */
    public static function label(string $role): string
    {
        return self::labels()[$role] ?? 'Unknown';
    }

    /**
     * Bootstrap / Tailwind badge classes
     */
    public static function badgeClass(string $role): string
    {
        return match ($role) {
            self::ADMIN => 'badge-light-danger',       // red
            self::EXECUTIVE => 'badge-light-primary',  // blue
            self::PUMP_MANAGER => 'badge-light-success', // green
            default => 'badge-light-secondary',
        };
    }
}
