<?php

namespace App\Domain\Date;

use DateTime;

class DateFormatter
{
    public static function formatDateIsoToIso8601(?string $dateIso): string {
        if (empty($dateIso)) {
            return '';
        }
        return (new DateTime($dateIso))->format('Y-m-d\TH:i:sO');
    }
}
