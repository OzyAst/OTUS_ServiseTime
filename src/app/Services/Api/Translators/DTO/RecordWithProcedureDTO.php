<?php

namespace App\Services\Api\Translators\DTO;

class RecordWithProcedureDTO extends RecordDTO
{
    protected ProcedureDTO $procedure;

    protected function setProcedure(array $value)
    {
        $this->procedure = ProcedureDTO::fromArray($value);
    }
}
