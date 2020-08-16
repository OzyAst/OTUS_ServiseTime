<?php

namespace App\Services\ProcedureTimes\DTOs;

use App\Services\DTO\DTO;

/**
 * @property-read int $procedure_id;
 * @property-read array $start;
 * @property-read array $end;
 * @property-read array $day;
 * @property-read array $day_off;
 *
 * Class FormProcedureTimeDTO
 * @package App\Services\ProcedureTimes\DTOs
 */
class FormProcedureTimeDTO extends DTO
{
    protected int $procedure_id;
    protected array $start;
    protected array $end;
    protected array $day;
    protected array $day_off;

    private function __construct(
        int $procedure_id,
        array $start,
        array $end,
        array $day,
        array $day_off
    )
    {
        $this->procedure_id = $procedure_id;
        $this->start = $start;
        $this->end = $end;
        $this->day = $day;
        $this->day_off = array_pad($day_off, 7, "0");
    }

    public static function fromArray(array $data)
    {
        return new static(
            $data['procedure_id'],
            $data['start'],
            $data['end'],
            $data['day'],
            $data['day_off'],
        );
    }
}
