<?php

namespace App\Services\Records\Handlers;

use App\Models\Record;
use App\Models\User;
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

    public function handle(RecordCreateDTO $DTO, User $user): Record
    {
        $procedure = $this->procedureRepository->find($DTO->procedure_id);
        if (!$procedure) {
            abort(404);
        }

        $handlerDTO = RecordCreateHandlerDTO::fromArray(
            array_merge($DTO->toArray(), [
                'client_id' => $user->id,
                'business_id' => $procedure->business_id,
                'price' => $procedure->price,
                'user_create' => Auth::id(),
            ])
        );

        $record = $this->repository->create($handlerDTO);
        return $record;
    }
}
