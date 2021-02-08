<?php

namespace App\Services\BusinessContacts\Handlers;

use App\Models\BusinessContact;
use App\Services\BusinessContacts\DTOs\CreateFormBusinessContactDTO;
use App\Services\BusinessContacts\Repositories\BusinessContactRepositoryInterface;

/**
 * Добавление контакта к адресу салона
 * Class BusinessCreateHandler
 * @package App\Services\BusinessContacts\Handlers
 */
class BusinessContactCreateHandler
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

    public function handle(CreateFormBusinessContactDTO $createDTO): BusinessContact
    {
        return $this->repository->create($createDTO);
    }
}
