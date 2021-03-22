<?php

namespace App\Services\Records\Handlers;

use App\Models\User;
use App\Services\Records\DTO\RecordUpdateBusinessDTO;
use App\Services\Records\Repositories\RecordRepositoryInterface;

/**
 * Обновить запись для бизнеса
 */
class RecordBusinessUpdateHandler
{
    private RecordRepositoryInterface $repository;

    public function __construct(
        RecordRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    public function handle(RecordUpdateBusinessDTO $DTO, int $record_id, User $user): bool
    {
        $record = $this->repository->findByBusinessIdOrFail($record_id, $user->business->id);
        $record->setRawAttributes($DTO->toArray());

        return $this->repository->update($record);
    }
}
