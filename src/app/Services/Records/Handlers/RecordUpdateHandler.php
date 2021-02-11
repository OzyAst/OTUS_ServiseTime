<?php

namespace App\Services\Records\Handlers;

use App\Models\User;
use App\Services\Records\DTO\RecordUpdateDTO;
use App\Services\Records\Repositories\RecordRepositoryInterface;

/**
 * Обновить запись
 */
class RecordUpdateHandler
{
    private RecordRepositoryInterface $repository;

    public function __construct(
        RecordRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    public function handle(RecordUpdateDTO $DTO, int $record_id, User $user): bool
    {
        $record = $this->repository->findByClientIdOrFail($record_id, $user->id);
        $record->setRawAttributes($DTO->toArray());

        return $this->repository->update($record);
    }
}
