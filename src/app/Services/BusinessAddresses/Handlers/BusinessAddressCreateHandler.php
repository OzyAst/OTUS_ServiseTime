<?php

namespace App\Services\BusinessAddresses\Handlers;

use App\Models\BusinessAddress;
use App\Services\BusinessAddresses\DTOs\FormBusinessAddressDTO;
use App\Services\BusinessAddresses\DTOs\CreateFormBusinessAddressDTO;
use App\Services\BusinessAddresses\Repositories\BusinessAddressRepositoryInterface;
use Illuminate\Support\Facades\Auth;

/**
 * Добавление адреса салона
 * Class BusinessCreateHandler
 * @package App\Services\BusinessAddresses\Handlers
 */
class BusinessAddressCreateHandler
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

    public function handle(FormBusinessAddressDTO $formDTO): BusinessAddress
    {
        $createDTO = CreateFormBusinessAddressDTO::fromArray(
            array_merge($formDTO->toArray(), [
                'business_id' => Auth::user()->business->id
            ])
        );

        $model = $this->repository->create($createDTO);
        return $model;
    }
}
