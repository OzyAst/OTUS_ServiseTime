<?php

namespace App\Services\Api\Translators;

use App\Models\Record;
use App\Services\Api\Translators\DTO\RecordWithProcedureDTO;

/**
 * Данные для вывода календаря с расписанием для процедуры
 */
class ApiRecordsForCalendarTranslator extends ApiBaseTranslator
{
    /**
     * @param Record $item
     * @return RecordWithProcedureDTO
     */
    public function translate($item): RecordWithProcedureDTO
    {
        return RecordWithProcedureDTO::fromArray(array_merge(
            $item->toArray(),
            ["procedure" => $item->procedure->toArray()]
        ));
    }
}
