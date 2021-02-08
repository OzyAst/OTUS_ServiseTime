<?php

namespace App\Services\BusinessContacts;

use App\Models\BusinessContact;
use App\Services\BusinessContacts\DTOs\CreateFormBusinessContactDTO;
use App\Services\BusinessContacts\DTOs\UpdateFormBusinessContactDTO;
use App\Services\BusinessContacts\Handlers\BusinessContactCreateHandler;
use App\Services\BusinessContacts\Handlers\BusinessContactDeleteHandler;
use App\Services\BusinessContacts\Handlers\BusinessContactUpdateHandler;
use App\Services\BusinessContacts\Repositories\BusinessContactRepositoryInterface;

class BusinessContactService
{

    /**
     * @var BusinessContactCreateHandler
     */
    private $createHandler;
    /**
     * @var BusinessContactRepositoryInterface
     */
    private $repository;
    /**
     * @var BusinessContactUpdateHandler
     */
    private $updateHandler;
    /**
     * @var BusinessContactDeleteHandler
     */
    private $deleteHandler;

    public function __construct(
        BusinessContactCreateHandler $createHandler,
        BusinessContactUpdateHandler $updateHandler,
        BusinessContactDeleteHandler $deleteHandler,
        BusinessContactRepositoryInterface $repository
    )
    {
        $this->createHandler = $createHandler;
        $this->repository = $repository;
        $this->updateHandler = $updateHandler;
        $this->deleteHandler = $deleteHandler;
    }

    /**
     * Добавление записи
     * @param array $data
     * @return BusinessContact
     */
    public function create(array $data): BusinessContact
    {
        $address =  CreateFormBusinessContactDTO::fromArray($data);
        return $this->createHandler->handle($address);
    }

    /**
     * Обновить данные салона
     * @param array $data
     * @param BusinessContact $model
     */
    public function update(array $data, BusinessContact $model)
    {
        $formDTO =  UpdateFormBusinessContactDTO::fromArray($data);
        $this->updateHandler->handle($formDTO, $model);
    }

    /**
     * Удалить запись
     * @param BusinessContact $model
     */
    public function delete(BusinessContact $model)
    {
        $this->deleteHandler->handle($model);
    }
}
