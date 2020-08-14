<?php

namespace App\Services\BusinessAddresses\Handlers;

use App\Models\BusinessAddress;
use App\Services\BusinessAddresses\DTOs\UpdateFormBusinessUpdateDTO;
use App\Services\BusinessAddresses\Repositories\BusinessAddressRepositoryInterface;

class BusinessAddressDeleteHandler
{

    /**
     * @var BusinessAddressRepositoryInterface
     */
    private $repository;

    public function __construct(
        BusinessAddressRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    public function handle(BusinessAddress $model): bool
    {
        return $this->repository->delete($model);
    }
}
