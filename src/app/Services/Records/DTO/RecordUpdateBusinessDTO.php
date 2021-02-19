<?php

namespace App\Services\Records\DTO;

use App\Services\DTO\DTO;

/**
 * Обновление записи для бизнеса
 *
 * @property-read int $procedure_id;
 * @property-read string $date_start;
 * @property-read string $date_end;
 * @property-read int $status;
 * @property-read float $price;
 */
class RecordUpdateBusinessDTO extends DTO
{
    protected int $procedure_id;
    protected string $date_start;
    protected string $date_end;
    protected int $status;
    protected float $price;
}
