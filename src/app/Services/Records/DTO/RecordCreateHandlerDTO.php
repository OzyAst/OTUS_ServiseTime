<?php

namespace App\Services\Records\DTO;

use App\Services\DTO\DTO;

/**
 * Данные для отправки в репозиторий для создание записи
 * @property-read int $business_id;
 * @property-read int $procedure_id;
 * @property-read int $client_id;
 * @property-read string $date_start;
 * @property-read string $date_end;
 * @property-read float $price;
 * @property-read float $user_create;
 */
class RecordCreateHandlerDTO extends DTO
{
    protected int $business_id;
    protected int $procedure_id;
    protected int $client_id;
    protected string $date_start;
    protected string $date_end;
    protected float $price;
    protected int $user_create;
}
