<?php

namespace App\Services\Week;

/**
 * Дни недели
 * Class Week
 * @package App\Services\Week
 */
class Week
{
    /**
     * Ключи с днями неделями
     * подходит для локализации
     * @var array
     */
    private static $week = [
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday',
    ];

    /**
     * Вернуть массив с днями неделями
     * @return array
     */
    public static function getWeeks(): array
    {
        return self::$week;
    }

    /**
     * Вернуть ключ дня недели
     * @param int $day
     * @return array
     */
    public static function getWeek(int $day): array
    {
        if (isset(self::$week[$day])) {
            return self::$week[$day];
        } else {
            return null;
        }
    }
}
