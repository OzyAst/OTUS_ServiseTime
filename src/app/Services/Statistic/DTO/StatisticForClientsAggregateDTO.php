<?php

namespace App\Services\Statistic\DTO;

use App\Services\DTO\DTO;

/**
 * @property int $client_id
 * @property string $client_name
 * @property StatisticForRecordsAggregateDTO[] $procedures
 */
class StatisticForClientsAggregateDTO extends DTO
{
    protected int $client_id;
    protected string $client_name;
    protected array $procedures = [];

    public function setProcedures($value)
    {
        $this->procedures[$value['procedure_id']] = StatisticForRecordsAggregateDTO::fromArray($value);
    }
}
