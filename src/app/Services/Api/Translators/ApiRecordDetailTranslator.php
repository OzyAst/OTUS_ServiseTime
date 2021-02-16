<?php

namespace App\Services\Api\Translators;

use App\Models\Record;
use App\Services\Api\Translators\DTO\RecordDTO;

/**
 * Данные записи
 */
class ApiRecordDetailTranslator extends ApiBaseTranslator
{
    /**
     * @param Record $item
     * @return RecordDTO
     */
    public function translate($item): RecordDTO
    {
        return RecordDTO::fromArray($item->toArray());
    }
}
