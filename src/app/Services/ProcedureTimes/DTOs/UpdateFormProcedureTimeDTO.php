<?php

namespace App\Services\ProcedureTimes\DTOs;

use App\Services\DTO\DTO;

class UpdateFormProcedureTimeDTO extends DTO
{
    protected string $start;
    protected string $end;
    protected int $day;
    protected bool $day_off;

    public function __construct(
        string $start,
        string $end,
        int $day,
        bool $day_off
    )
    {
        $this->start = $start;
        $this->end = $end;
        $this->day = $day;
        $this->day_off = $day_off;
    }

    public static function fromArray(array $data)
    {
        return new static(
            $data['start'],
            $data['end'],
            $data['day'],
            $data['day_off'],
        );
    }
}
