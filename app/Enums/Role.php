<?php

namespace App\Enums;

enum Role: string
{
    // الأدمن
    case Admin = 'admin';

    // السائق
    case Driver = 'driver';

    // الراكب
    case Rider = 'rider';

    /**
     * إرجاع كل القيم كمصفوفة
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * التحقق هل المستخدم أدمن
     */
    public function isAdmin(): bool
    {
        return $this === self::Admin;
    }

    /**
     * التحقق هل المستخدم سائق
     */
    public function isDriver(): bool
    {
        return $this === self::Driver;
    }

    /**
     * التحقق هل المستخدم راكب
     */
    public function isRider(): bool
    {
        return $this === self::Rider;
    }
}
