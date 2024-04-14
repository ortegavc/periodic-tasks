<?php

namespace App\Enums;

enum TaskPeriod: string
{
    case Once = 'once';
    case Daily = 'daily';
    case Monthly = 'monthly';
    case Monday = 'monday';
    case Wednesday = 'wednesday';
    case Friday = 'friday';

    public function description():string
    {
        return match ($this) {
             self::Once => 'Once',
             self::Daily => 'Every day',
             self::Monday => 'Every Monday',
             self::Wednesday => 'Every Wednesday',
             self::Friday => 'Every Friday',
             self::Monthly => 'Every 5th of each month',
        };
    }

    public static function valueDescription(): array
    {
        return array_combine(
            array_values(array_map(fn($case) => $case->value, self::cases())),
            array_values(array_map(fn($case) => $case->description(), self::cases()))
        );
    }
}