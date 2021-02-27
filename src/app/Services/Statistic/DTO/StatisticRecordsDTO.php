<?php

namespace App\Services\Statistic\DTO;

/**
 * Class StatisticRecordsDTO
 *
 * @property $count_records
 * @property $count_records_done
 * @property $records_done_count
 *
 * @package App\Services\Statistic\DTOs
 */
class StatisticRecordsDTO
{
    private int $count_records;
    private int $count_records_done;
    private int $records_done_count;

    public function __construct(
        int $count_records,
        int $count_records_done,
        int $records_done_count
    ) {
        $this->count_records = $count_records;
        $this->count_records_done = $count_records_done;
        $this->records_done_count = $records_done_count;
    }

    public static function fromArray(array $data)
    {
        return new static(
            $data['count_records'],
            $data['count_records_done'],
            $data['records_done_count'],
        );
    }

    public function toArray(): array
    {
        return [
            'count_records' => $this->count_records,
            'count_records_done' => $this->count_records_done,
            'records_done_count' => $this->records_done_count,
        ];
    }
}
