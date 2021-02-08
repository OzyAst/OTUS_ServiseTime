<?php

namespace App\Services\BusinessAddresses\Repositories;

use App\Models\BusinessAddress;
use App\Services\BusinessAddresses\DTOs\CreateFormBusinessAddressDTO;
use Illuminate\Database\Eloquent\Collection;

interface BusinessAddressRepositoryInterface
{
    /**
     * Найти запись по ID
     * @param int $id
     * @return BusinessAddress|null
     */
    public function find(int $id): ?BusinessAddress;

    /**
     * Вернет адреса салона
     * @param int $user_id
     * @return Collection|null
     */
    public function findByBusinessId(int $user_id): ?Collection;

    /**
     * Создать запись
     * @param CreateFormBusinessAddressDTO $createDTO
     * @return Business|null
     */
    public function create(CreateFormBusinessAddressDTO $createDTO): ?BusinessAddress;

    /**
     * Обновить запись
     * @param BusinessAddress $model
     * @return BusinessAddress
     */
    public function update(BusinessAddress $model): BusinessAddress;
//    public function get();
//    public function search(array $filter = []);

    /**
     * Удалить запись
     * @param BusinessAddress $model
     * @return bool
     */
    public function delete(BusinessAddress $model): bool;
}
