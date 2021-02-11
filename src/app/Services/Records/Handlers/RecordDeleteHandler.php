<?php

namespace App\Services\Records\Handlers;

use App\Models\User;
use App\Services\Records\Repositories\RecordRepositoryInterface;

/**
 * Удаление записи
 */
class RecordDeleteHandler
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

        return $this->repository->delete($record);
    }
}
