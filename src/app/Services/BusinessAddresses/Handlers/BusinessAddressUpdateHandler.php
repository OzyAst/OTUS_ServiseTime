<?php

namespace App\Services\BusinessAddresses\Handlers;

use App\Models\BusinessAddress;
use App\Services\BusinessAddresses\DTOs\FormBusinessAddressDTO;
use App\Services\BusinessAddresses\Repositories\BusinessAddressRepositoryInterface;

/**
 * Редактирование данных салона
 * Class BusinessUpdateHandler
 * @package App\Services\BusinessAddresses\Handlers
 */
class BusinessAddressUpdateHandler
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

    public function handle(FormBusinessAddressDTO $updateDTO, BusinessAddress $model): BusinessAddress
    {
        $model->setRawAttributes($updateDTO->toArray());
        return $this->repository->update($model);
    }
}
