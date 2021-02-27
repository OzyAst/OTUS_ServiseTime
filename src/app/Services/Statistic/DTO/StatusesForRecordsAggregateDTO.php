<?php

namespace App\Services\Statistic\DTO;

use App\Models\Record;
use App\Services\DTO\DTO;

/**
 * @property int $count
 * @property float $sum_price
 * @property int $status
 * @property string $status_key
 */
class StatusesForRecordsAggregateDTO extends DTO
{
    protected int $count;
    protected float $sum_price;
    protected int $status;
    protected string $status_key;

    protected function setStatus_key($value)
    {
        $this->status_key = Record::STATUS_KEYS[$value] ?? '';
    }
}
