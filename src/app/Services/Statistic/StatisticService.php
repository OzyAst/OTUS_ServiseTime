<?php

namespace App\Services\Statistic;

use App\Services\Records\Repositories\RecordRepositoryInterface;
use App\Services\Statistic\DTOs\StatisticRecordsDTO;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class StatisticService
{

    /**
     * @var RecordRepositoryInterface
     */
    private $recordRepository;

    public function __construct(
        RecordRepositoryInterface $recordRepository
    ) {
        $this->recordRepository = $recordRepository;
    }

    /**
     * Списк всех процедур для салона
     */
    public function getStatusToday(): ?array
    {
        $date = Carbon::today();

        if (Auth::guest()) {
            return null;
        }

        return (new StatisticRecordsDTO(
            $this->recordRepository->countRecords(Auth::user()->business->id, $date, $date),
            $this->recordRepository->countRecordsDone(Auth::user()->business->id, $date, $date),
            $this->recordRepository->sumPriceRecords(Auth::user()->business->id, $date, $date)
        ))->toArray();
    }

    /**
     * Списк всех процедур для салона
     * @throws \Exception
     */
    public function getStatusMonth(): ?array
    {
        $date_start = new Carbon('first day of ' . date("M Y"));
        $date_end = new Carbon('last day of ' . date("M Y"));

        if (Auth::guest()) {
            return null;
        }

        return (new StatisticRecordsDTO(
            $this->recordRepository->countRecords(Auth::user()->business->id, $date_start, $date_end),
            $this->recordRepository->countRecordsDone(Auth::user()->business->id, $date_start, $date_end),
            $this->recordRepository->sumPriceRecords(Auth::user()->business->id, $date_start, $date_end)
        ))->toArray();
    }
}
