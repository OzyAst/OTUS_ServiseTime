<?php

namespace App\Services\BusinessContacts\Handlers;

use App\Models\BusinessContact;
use App\Services\BusinessContacts\DTOs\UpdateFormBusinessContactDTO;
use App\Services\BusinessContacts\Repositories\BusinessContactRepositoryInterface;

/**
 * Редактирование контактов для адреса салона
 * Class BusinessUpdateHandler
 * @package App\Services\BusinessContacts\Handlers
 */
class BusinessContactUpdateHandler
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

    public function handle(UpdateFormBusinessContactDTO $updateDTO, BusinessContact $model): BusinessContact
    {
        $model->setRawAttributes($updateDTO->toArray());
        return $this->repository->update($model);
    }
}
