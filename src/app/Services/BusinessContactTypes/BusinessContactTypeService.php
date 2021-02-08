<?php

namespace App\Services\BusinessContactTypes;

use App\Services\BusinessContactTypes\Repositories\BusinessContactTypeRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class BusinessContactTypeService
{

    /**
     * @var BusinessContactTypeRepositoryInterface
     */
    private $repository;

    public function __construct(
        BusinessContactTypeRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    /**
     * Списк всех типов
     * @return Collection|null
     */
    public function list(): ?Collection
    {
        return $this->repository->get();
    }
}
