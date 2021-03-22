<?php

namespace App\Services\Records\DTO;

use App\Services\DTO\DTO;

/**
 * Создание записи
 * @property-read int $procedure_id;
 * @property-read int $client_id;
 * @property-read string $date_start;
 */
class RecordCreateDTO extends DTO
{
    protected int $procedure_id;
    protected int $client_id;
    protected string $date_start;
}
