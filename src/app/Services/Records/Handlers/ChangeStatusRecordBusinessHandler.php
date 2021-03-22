<?php

namespace App\Services\Records\Handlers;

use App\Models\User;
use App\Services\Records\Repositories\RecordRepositoryInterface;

/**
 * Обновить статус записи для бизнеса
 */
class ChangeStatusRecordBusinessHandler
{
    private RecordRepositoryInterface $repository;

    public function __construct(
        RecordRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    public function handle(int $status, int $record_id, User $user): bool
    {
        $record = $this->repository->findByBusinessIdOrFail($record_id, $user->business->id);
        $record->status = $status;

        return $this->repository->update($record);
    }
}
