<?php

namespace App\Services\Api\Translators;

use App\Models\Record;
use App\Services\Api\Translators\DTO\RecordWithProcedureDTO;
use Illuminate\Database\Eloquent\Collection;

class ApiTranslatorService
{
    private ApiRecordsForCalendarTranslator $apiRecordsForCalendarTranslator;
    private ApiRecordDetailTranslator $apiRecordDetailTranslator;

    public function __construct(
        ApiRecordsForCalendarTranslator $apiRecordsForCalendarTranslator,
        ApiRecordDetailTranslator $apiRecordDetailTranslator
    )
    {
        $this->apiRecordsForCalendarTranslator = $apiRecordsForCalendarTranslator;
        $this->apiRecordDetailTranslator = $apiRecordDetailTranslator;
    }

    /**
     * Вернет данные для вывода календаря с расписанием для процедуры
     * @param Collection $collection
     * @return array|RecordWithProcedureDTO
     */
    public function translateRecordsForCalendar(Collection $collection): array
    {
        $recordsListDTOs = $this->apiRecordsForCalendarTranslator->translateAll($collection);
        return array_map(function ($item) {
            return $item->toArray();
        }, $recordsListDTOs);
    }

    /**
     * Вернет данные для вывода информации о записи
     * @param Record $record
     * @return array
     */
    public function translateRecordDetail(Record $record): array
    {
        $recordDTO = $this->apiRecordDetailTranslator->translate($record);
        return $recordDTO->toArray();
    }
}
