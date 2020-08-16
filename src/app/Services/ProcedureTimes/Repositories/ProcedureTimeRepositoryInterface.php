<?php

namespace App\Services\ProcedureTimes\Repositories;

use App\Models\ProcedureTime;
use App\Services\ProcedureTimes\DTOs\CreateFormProcedureTimeDTO;
use Illuminate\Database\Eloquent\Collection;

interface ProcedureTimeRepositoryInterface
{
    /**
     * Найти запись по ID
     * @param int $id
     * @return ProcedureTime|null
     */
    public function find(int $id): ?ProcedureTime;

    /**
     * Вернет адреса салона
     * @param int $user_id
     * @return Collection|null
     */
    public function findByBusinessId(int $user_id): ?Collection;

    /**
     * Создать запись
     * @param CreateFormProcedureTimeDTO $createDTO
     * @return Business|null
     */
    public function create(CreateFormProcedureTimeDTO $createDTO): ?ProcedureTime;

    /**
     * Обновить запись
     * @param ProcedureTime $model
     * @return ProcedureTime
     */
    public function update(ProcedureTime $model): ProcedureTime;

    /**
     * Удалить запись
     * @param ProcedureTime $model
     * @return bool
     */
    public function delete(ProcedureTime $model): bool;

    /**
     * Вернет расписание не привязанное к процедуре.
     * Т.е. расписание для всего салона
     * @param int $business_id
     * @return Collection|null
     */
    public function getTimeDefault(int $business_id): ?Collection;
}
