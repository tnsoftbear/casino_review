<?php

namespace App\Domain\Date;

use DateTime;
use DateTimeZone;
use App\Domain\Constants\DateConstants;

class DateTzConverter
{
    public static function convertDateIsoToUtcByTzOffset(?string $dateIso, int $tzOffset): ?string
    {
        if (empty($dateIso) || $tzOffset === 0) {
            return $dateIso;
        }

        $dt = new DateTime($dateIso, new DateTimeZone('UTC'));
        $dt->modify("$tzOffset minutes");
        return $dt->format(DateConstants::DT_ISO_FORMAT);
    }

    public static function convertDateIsoUtcByTzOffset(?string $dateIsoUtc, int $tzOffset): ?string
    {
        if (empty($dateIsoUtc) || $tzOffset === 0) {
            return $dateIsoUtc;
        }

        $dt = new DateTime($dateIsoUtc);
        $dt->modify(-1 * $tzOffset . " minutes");
        return $dt->format(DateConstants::DT_ISO_FORMAT);
    }

    public static function convertArrayOfDateIsoToUtcByTzOffset(array $datesIso, int $tzOffset): array
    {
        foreach ($datesIso as $key => $value) {
            $datesIso[$key] = self::convertDateIsoToUtcByTzOffset($value, $tzOffset);
        }
        return $datesIso;
    }

    public static function convertAndUpdateArrayOfDateIsoToUtcByTzOffset($input, $keys, $tzOffset)
    {
        $datesIso = array_intersect_key($input, array_flip($keys));
        $datesUtcIso = self::convertArrayOfDateIsoToUtcByTzOffset($datesIso, $tzOffset);
        return array_merge($input, $datesUtcIso);
    }
}
