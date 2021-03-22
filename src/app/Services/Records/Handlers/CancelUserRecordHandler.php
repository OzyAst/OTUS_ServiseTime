<?php

namespace App\Services\Records\Handlers;

use App\Models\Record;
use App\Models\User;
use App\Services\Records\Repositories\RecordRepositoryInterface;

/**
 * Отменить запись пользователя
 */
class CancelUserRecordHandler
{
    private RecordRepositoryInterface $repository;

    public function __construct(
        RecordRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    public function handle(int $record_id, User $user): bool
    {
        $record = $this->repository->findByClientIdOrFail($record_id, $user->id);
        $record->status = Record::STATUS_CANCELED;

        return $this->repository->update($record);
    }
}
