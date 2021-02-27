<?php

namespace App\Services\Statistic\DTO;

use App\Services\DTO\DTO;

/**
 * @property int $count
 * @property float $sum_price
 * @property string $procedure_name
 * @property string $client_name
 * @property int $price
 * @property int $procedure_id
 * @property int $client_id
 * @property int $status
 */
class StatisticForClientsDTO extends DTO
{
    protected int $count;
    protected float $sum_price;
    protected string $procedure_name;
    protected string $client_name;
    protected int $price;
    protected int $procedure_id;
    protected int $client_id;
    protected int $status;
}
