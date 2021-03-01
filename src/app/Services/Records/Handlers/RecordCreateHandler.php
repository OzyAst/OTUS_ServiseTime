<?php

namespace App\Services\Records\Handlers;

use App\Models\Record;
use App\Services\Procedures\Repositories\ProcedureRepositoryInterface;
use App\Services\Records\DTO\RecordCreateDTO;
use App\Services\Records\DTO\RecordCreateHandlerDTO;
use App\Services\Records\Repositories\RecordRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

/**
 * Добавление записи
 */
class RecordCreateHandler
{

    private RecordRepositoryInterface $repository;
    private ProcedureRepositoryInterface $procedureRepository;

    public function __construct(
        RecordRepositoryInterface $repository,
        ProcedureRepositoryInterface $procedureRepository
    )
    {
        $this->repository = $repository;
        $this->procedureRepository = $procedureRepository;
    }

    public function handle(RecordCreateDTO $DTO): Record
    {
        $procedure = $this->procedureRepository->find($DTO->procedure_id);
        if (!$procedure) {
            abort(404);
        }

        $handlerDTO = RecordCreateHandlerDTO::fromArray(
            array_merge($DTO->toArray(), [
                'date_end' => Carbon::parse($DTO->date_start)->addMinutes($procedure->duration)->format("Y-m-d H:i"),
                'business_id' => $procedure->business_id,
                'price' => $procedure->price,
                'user_create' => Auth::id(),
            ])
        );

        if (!$this->checkRecordingAvailability($handlerDTO)) {
            throw new \InvalidArgumentException("Данная процедура занята на это время");
        }

        $record = $this->repository->create($handlerDTO);
        return $record;
    }

    /**
     * Проверить возможна ли запись
     * @param RecordCreateHandlerDTO $dto
     * @return bool
     */
    private function checkRecordingAvailability(RecordCreateHandlerDTO $dto): bool
    {
        if ($this->repository->countRecordsByProcedure($dto->procedure_id, $dto->date_start, $dto->date_end)) {
            return false;
        } else {
            return true;
        }
    }
}
