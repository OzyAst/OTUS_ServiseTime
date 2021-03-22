<?php

namespace App\Services\Api\Translators\DTO;

use App\Services\DTO\DTO;

class RecordDTO extends DTO
{
    protected int $id;
    protected int $business_id;
    protected int $procedure_id;
    protected int $client_id;
    protected string $date_start;
    protected string $date_end;
    protected int $status;
    protected float $price;
    protected string $created_at;
    protected string $updated_at;
}
