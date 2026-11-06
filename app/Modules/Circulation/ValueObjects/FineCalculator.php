<?php

namespace App\Modules\Circulation\ValueObjects;

use DateTime;

class FineCalculator
{
    private const DAILY_FINE = 2000;

    public static function calculate(string $dueDate, string $returnDate): float
    {
        $due = new DateTime($dueDate);
        $return = new DateTime($returnDate);

        if ($return <= $due) {
            return 0.0;
        }

        $daysOverdue = $return->diff($due)->days;
        return (float) ($daysOverdue * self::DAILY_FINE);
    }
}