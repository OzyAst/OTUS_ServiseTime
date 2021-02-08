<?php

namespace App\Services\ProcedureTimes\Handlers;

use App\Models\Procedure;
use App\Services\ProcedureTimes\DTOs\FormProcedureTimeDTO;
use App\Services\ProcedureTimes\DTOs\UpdateFormProcedureTimeDTO;
use App\Services\ProcedureTimes\Repositories\ProcedureTimeRepositoryInterface;

/**
 * Редактирование контактов для адреса салона
 * Class BusinessUpdateHandler
 * @package App\Services\ProcedureTimes\Handlers
 */
class ProcedureTimeUpdateHandler
{

    /**
     * @var ProcedureTimeRepositoryInterface
     */
    private $repository;

    public function __construct(
        ProcedureTimeRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    public function handle(FormProcedureTimeDTO $formDTO, Procedure $procedure): array
    {
        $procedureTimes = [];

        foreach ($procedure->times as $time) {
            $updateDTO = new UpdateFormProcedureTimeDTO(
                $formDTO->start[$time->day],
                $formDTO->end[$time->day],
                $time->day,
                $formDTO->day_off[$time->day]
            );

            $time->setRawAttributes($updateDTO->toArray());
            $procedureTimes[] = $this->repository->update($time);
        }

        return $procedureTimes;
    }
}
