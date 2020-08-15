<?php

namespace App\Services\BusinessContacts\Handlers;

use App\Models\BusinessContact;
use App\Services\BusinessContacts\Repositories\BusinessContactRepositoryInterface;

class BusinessContactDeleteHandler
{

    /**
     * @var BusinessContactRepositoryInterface
     */
    private $repository;

    public function __construct(
        BusinessContactRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    public function handle(BusinessContact $model): bool
    {
        return $this->repository->delete($model);
    }
}
