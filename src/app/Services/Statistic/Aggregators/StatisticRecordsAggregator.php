<?php

namespace App\Services\Statistic\Aggregators;

use App\Services\Statistic\DTO\StatisticForRecordsAggregateDTO;
use App\Services\Statistic\DTO\StatisticForRecordsDTO;

class StatisticRecordsAggregator
{
    /**
     * @param StatisticForRecordsDTO[] $statistic
     * @return StatisticForRecordsAggregateDTO[]
     */
    public function aggregate(array $statistic)
    {
        $new_statistic = [];

        foreach($statistic as $item) {
            $status = array_merge(['status_key' => $item->status], $item->toArray());

            if (!isset($new_statistic[$item->procedure_id])) {
                $new_statistic[$item->procedure_id] = StatisticForRecordsAggregateDTO::fromArray([
                    'procedure_id' => $item->procedure_id,
                    'procedure_name' => $item->procedure_name,
                    'price' => $item->price,
                    'statuses' => $status
                ]);
            } else {
                $new_statistic[$item->procedure_id]->setStatuses($status);
            }
        }

        return $new_statistic;
    }
}
