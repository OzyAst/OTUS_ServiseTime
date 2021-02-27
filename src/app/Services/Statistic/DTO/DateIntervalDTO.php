<?php

namespace App\Services\Statistic\DTO;

use App\Services\DTO\DTO;
use Carbon\Carbon;

/**
 * Интервал для статистики
 * @property string $date_start
 * @property string $date_end
 */
class DateIntervalDTO extends DTO
{
    protected Carbon $date_start;
    protected Carbon $date_end;

    public function setDate_start($value)
    {
        $value = $value ? Carbon::parse($value) : new Carbon('first day of ' . date("M Y"));
        $this->date_start = $value;
    }

    protected function setDate_end($value)
    {
        $value = $value ? Carbon::parse($value) : new Carbon('last day of  ' . date("M Y"));
        $this->date_end = $value;
    }
}
