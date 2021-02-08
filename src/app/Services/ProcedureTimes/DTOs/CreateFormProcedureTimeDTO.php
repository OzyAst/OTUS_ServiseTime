<?php

namespace App\Services\ProcedureTimes\DTOs;

use App\Services\DTO\DTO;

class CreateFormProcedureTimeDTO extends DTO
{
    protected int $business_id;
    protected int $procedure_id;
    protected string $start;
    protected string $end;
    protected int $day;
    protected bool $day_off;

    public function __construct(
        int $business_id,
        int $procedure_id,
        string $start,
        string $end,
        int $day,
        bool $day_off
    )
    {
        $this->business_id = $business_id;
        $this->procedure_id = $procedure_id;
        $this->start = $start;
        $this->end = $end;
        $this->day = $day;
        $this->day_off = $day_off;
    }

    public static function fromArray(array $data)
    {
        return new static(
            $data['business_id'],
            $data['procedure_id'],
            $data['start'],
            $data['end'],
            $data['day'],
            $data['day_off'],
        );
    }
}
