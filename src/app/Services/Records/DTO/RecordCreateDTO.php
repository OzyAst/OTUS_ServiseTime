<?php

namespace App\Services\Records\DTO;

use App\Services\DTO\DTO;

/**
 * Создание записи
 * @property-read int $procedure_id;
 * @property-read string $date_start;
 * @property-read string $date_end;
 */
class RecordCreateDTO extends DTO
{
    protected int $procedure_id;
    protected string $date_start;
    protected string $date_end;
}
