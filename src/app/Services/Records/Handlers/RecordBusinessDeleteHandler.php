<?php

namespace App\Services\Records\Handlers;

use App\Services\Records\Repositories\RecordRepositoryInterface;

/**
 * Удаление записи бизнеса
 */
class RecordBusinessDeleteHandler
{
    private RecordRepositoryInterface $repository;

    public function __construct(
        RecordRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    public function handle(int $record_id, int $business_id): bool
    {
        $record = $this->repository->findByBusinessIdOrFail($record_id, $business_id);

        return $this->repository->delete($record);
    }
}
