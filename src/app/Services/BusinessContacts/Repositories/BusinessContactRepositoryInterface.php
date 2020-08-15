<?php

namespace App\Services\BusinessContacts\Repositories;

use App\Models\BusinessContact;
use App\Services\BusinessContacts\DTOs\CreateFormBusinessContactDTO;
use Illuminate\Database\Eloquent\Collection;

interface BusinessContactRepositoryInterface
{
    /**
     * Найти запись по ID
     * @param int $id
     * @return BusinessContact|null
     */
    public function find(int $id): ?BusinessContact;

    /**
     * Вернет адреса салона
     * @param int $user_id
     * @return Collection|null
     */
    public function findByBusinessId(int $user_id): ?Collection;

    /**
     * Создать запись
     * @param CreateFormBusinessContactDTO $createDTO
     * @return Business|null
     */
    public function create(CreateFormBusinessContactDTO $createDTO): ?BusinessContact;

    /**
     * Обновить запись
     * @param BusinessContact $model
     * @return BusinessContact
     */
    public function update(BusinessContact $model): BusinessContact;

    /**
     * Удалить запись
     * @param BusinessContact $model
     * @return bool
     */
    public function delete(BusinessContact $model): bool;
}
