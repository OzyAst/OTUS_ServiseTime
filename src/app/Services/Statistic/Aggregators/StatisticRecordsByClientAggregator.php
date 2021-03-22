<?php

namespace App\Services\Statistic\Aggregators;

use App\Services\Statistic\DTO\StatisticForClientsAggregateDTO;
use App\Services\Statistic\DTO\StatisticForClientsDTO;
use App\Services\Statistic\DTO\StatisticForRecordsAggregateDTO;

class StatisticRecordsByClientAggregator
{
    /**
     * @param StatisticForClientsDTO[] $statistic
     * @return StatisticForRecordsAggregateDTO[]
     */
    public function aggregate(array $statistic)
    {
        $new_statistic = [];

        foreach($statistic as $item) {
            $status = array_merge(['status_key' => $item->status], $item->toArray());
            $procedure = array_merge(['statuses' => $status], $item->toArray());

            if (!isset($new_statistic[$item->client_id])) {
                $new_statistic[$item->client_id] = StatisticForClientsAggregateDTO::fromArray([
                    'client_id' => $item->client_id,
                    'client_name' => $item->client_name,
                    'procedures' => $procedure,
                ]);
            } else {
                if (!isset($new_statistic[$item->client_id]->procedures[$item->procedure_id])) {
                    $new_statistic[$item->client_id]->setProcedures($procedure);
                }

                $new_statistic[$item->client_id]->procedures[$item->procedure_id]->setStatuses($status);
            }
        }

        return $new_statistic;
    }
}
