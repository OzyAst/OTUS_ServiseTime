<?php

namespace App\Services\Records\Handlers;

use App\Models\Record;
use App\Services\Procedures\Repositories\ProcedureRepositoryInterface;
use App\Services\Records\DTO\RecordCreateDTO;
use App\Services\Records\DTO\RecordCreateHandlerDTO;
use App\Services\Records\Repositories\RecordRepositoryInterface;
use Illuminate\Support\Facades\Auth;

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
                'date_end' => $procedure->duration + strtotime($DTO->date_start),
                'business_id' => $procedure->business_id,
                'price' => $procedure->price,
                'user_create' => Auth::id(),
            ])
        );

        $record = $this->repository->create($handlerDTO);
        return $record;
    }
}
