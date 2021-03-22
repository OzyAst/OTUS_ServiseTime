<?php

namespace App\Services\Statistic\DTO;

use App\Services\DTO\DTO;

/**
 * @property int $count
 * @property float $sum_price
 * @property string $procedure_name
 * @property int $price
 * @property int $procedure_id
 */
class StatisticSalaryDTO extends DTO
{
    protected int $count;
    protected float $sum_price;
    protected string $procedure_name;
    protected int $price;
    protected int $procedure_id;
}
