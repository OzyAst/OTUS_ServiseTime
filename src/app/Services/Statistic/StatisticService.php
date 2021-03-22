<?php

namespace App\Services\Statistic;

use App\Services\Records\Repositories\RecordRepositoryInterface;
use App\Services\Statistic\Aggregators\StatisticRecordsAggregator;
use App\Services\Statistic\Aggregators\StatisticRecordsByClientAggregator;
use App\Services\Statistic\DTO\DateIntervalDTO;
use App\Services\Statistic\DTO\StatisticForClientsDTO;
use App\Services\Statistic\DTO\StatisticForRecordsDTO;
use App\Services\Statistic\DTO\StatisticRecordsDTO;
use App\Services\Statistic\DTO\StatisticSalaryDTO;
use Carbon\Carbon;

class StatisticService
{
    private RecordRepositoryInterface $recordRepository;
    private StatisticRecordsAggregator $statisticRecordsAggregator;
    private StatisticRecordsByClientAggregator $statisticRecordsByClientAggregator;

    public function __construct(
        RecordRepositoryInterface $recordRepository,
        StatisticRecordsAggregator $statisticRecordsAggregator,
        StatisticRecordsByClientAggregator $statisticRecordsByClientAggregator
    ) {
        $this->recordRepository = $recordRepository;
        $this->statisticRecordsAggregator = $statisticRecordsAggregator;
        $this->statisticRecordsByClientAggregator = $statisticRecordsByClientAggregator;
    }

    /**
     * Списк всех процедур для салона
     * @param int $business_id
     * @return array|null
     */
    public function getStatusToday(int $business_id): ?array
    {
        $date = Carbon::today();

        return (new StatisticRecordsDTO(
            $this->recordRepository->countRecords($business_id, $date, $date),
            $this->recordRepository->countRecordsDone($business_id, $date, $date),
            $this->recordRepository->sumPriceRecords($business_id, $date, $date)
        ))->toArray();
    }

    /**
     * Списк всех процедур для салона
     * @param int $business_id
     * @return array|null
     * @throws \Exception
     */
    public function getStatusMonth(int $business_id): ?array
    {
        $date_start = new Carbon('first day of ' . date("M Y"));
        $date_end = new Carbon('last day of ' . date("M Y"));

        return (new StatisticRecordsDTO(
            $this->recordRepository->countRecords($business_id, $date_start, $date_end),
            $this->recordRepository->countRecordsDone($business_id, $date_start, $date_end),
            $this->recordRepository->sumPriceRecords($business_id, $date_start, $date_end)
        ))->toArray();
    }

    /**
     * Статистика по зарплате для бизнеса за интервал
     * @param $business_id
     * @param DateIntervalDTO $interval
     * @return StatisticSalaryDTO[]
     */
    public function statisticSalaryForInternal($business_id, DateIntervalDTO $interval): array
    {
        $statistic = $this->recordRepository->sumPriceForProcedureGroupWorker(
            $business_id,
            $interval->date_start,
            $interval->date_end
        );
        return StatisticSalaryDTO::allFromCollection($statistic);
    }

    /**
     * Статистика по записям для бизнеса за интервал
     * @param $business_id
     * @param DateIntervalDTO $interval
     * @return array
     */
    public function statisticRecordsForInternal($business_id, DateIntervalDTO $interval): array
    {
        $statistic = $this->recordRepository->countStatisticForRecords(
            $business_id,
            $interval->date_start,
            $interval->date_end
        );

        return $this->statisticRecordsAggregator->aggregate(StatisticForRecordsDTO::allFromCollection($statistic));
    }

    /**
     * Статистика по клиентам для бизнеса за интервал
     * @param $business_id
     * @param DateIntervalDTO $interval
     * @return array
     */
    public function statisticClientsForInternal($business_id, DateIntervalDTO $interval): array
    {
        $statistic = $this->recordRepository->statisticRecordsGroupByClients(
            $business_id,
            $interval->date_start,
            $interval->date_end
        );

        return $this->statisticRecordsByClientAggregator->aggregate(StatisticForClientsDTO::allFromCollection($statistic));
    }
}
