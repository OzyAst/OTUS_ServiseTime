<?php

namespace App\Services\Api\Translators\DTO;

use App\Services\DTO\DTO;

class ProcedureDTO extends DTO
{
    protected int $id;
    protected string $name;
    protected int $business_id;
    protected int $worker_id;
    protected int $duration;
    protected float $price;
    protected int $people_count;
}
