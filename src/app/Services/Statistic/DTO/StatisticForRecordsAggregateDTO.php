<?php

namespace App\Services\Statistic\DTO;

use App\Services\DTO\DTO;

/**
 * @property int $procedure_id
 * @property string $procedure_name
 * @property int $price
 * @property StatusesForRecordsAggregateDTO[] $statuses
 */
class StatisticForRecordsAggregateDTO extends DTO
{
    protected int $procedure_id;
    protected string $procedure_name;
    protected int $price;
    protected array $statuses = [];

    public function setStatuses($value)
    {
        $this->statuses[$value['status']] = StatusesForRecordsAggregateDTO::fromArray($value);
    }
}
