<?php

namespace App\Services\BusinessAddresses;

use App\Models\BusinessAddress;
use App\Services\BusinessAddresses\DTOs\FormBusinessAddressDTO;
use App\Services\BusinessAddresses\DTOs\UpdateFormBusinessUpdateDTO;
use App\Services\BusinessAddresses\Handlers\BusinessAddressCreateHandler;
use App\Services\BusinessAddresses\Handlers\BusinessAddressDeleteHandler;
use App\Services\BusinessAddresses\Handlers\BusinessAddressUpdateHandler;
use App\Services\BusinessAddresses\Repositories\BusinessAddressRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class BusinessAddressService
{

    /**
     * @var BusinessAddressCreateHandler
     */
    private $createHandler;
    /**
     * @var BusinessAddressRepositoryInterface
     */
    private $repository;
    /**
     * @var BusinessAddressUpdateHandler
     */
    private $updateHandler;
    /**
     * @var BusinessAddressDeleteHandler
     */
    private $deleteHandler;

    public function __construct(
        BusinessAddressCreateHandler $createHandler,
        BusinessAddressUpdateHandler $updateHandler,
        BusinessAddressDeleteHandler $deleteHandler,
        BusinessAddressRepositoryInterface $repository
    )
    {
        $this->createHandler = $createHandler;
        $this->repository = $repository;
        $this->updateHandler = $updateHandler;
        $this->deleteHandler = $deleteHandler;
    }

    /**
     * Списк всех адресов салонов
     * @return Collection|null
     */
    public function getMyAddress(): ?Collection
    {
        return $this->repository->findByBusinessId(Auth::user()->business->id);
    }

    /**
     * Добавление записи
     * @param array $data
     * @return BusinessAddress
     */
    public function create(array $data): BusinessAddress
    {
        $address =  FormBusinessAddressDTO::fromArray($data);
        return $this->createHandler->handle($address);
    }

    /**
     * Обновить данные салона
     * @param array $data
     * @param BusinessAddress $address
     */
    public function update(array $data, BusinessAddress $address)
    {
        $formDTO =  FormBusinessAddressDTO::fromArray($data);
        $this->updateHandler->handle($formDTO, $address);
    }

    /**
     * Удалить запись
     * @param BusinessAddress $model
     */
    public function delete(BusinessAddress $model)
    {
        $this->deleteHandler->handle($model);
    }
}
