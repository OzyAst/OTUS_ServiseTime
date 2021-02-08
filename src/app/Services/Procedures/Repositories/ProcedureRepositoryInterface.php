<?php

namespace App\Services\Procedures\Repositories;

use App\Models\Procedure;
use App\Services\Procedures\DTOs\ProcedureHandlerDTO;
use Illuminate\Database\Eloquent\Collection;

interface ProcedureRepositoryInterface
{
    public function find(int $id): ?Procedure;
    public function create(ProcedureHandlerDTO $DTO): ?Procedure;
    public function update(Procedure $procedure): Procedure;
    public function get();
    public function search(array $filter = []);
    public function delete(Procedure $procedure): bool;

    /**
     * Список всех процедур бизнеса
     * @param int $business_id
     * @return Collection|null
     */
    public function getByBusinessId(int $business_id): ?Collection;

    /**
     * Процедура бизнеса по ее ID
     * @param int $business_id
     * @param int $procedure_id
     * @return Procedure|null
     */
    public function findByBusinessId(int $business_id, int $procedure_id): ?Procedure;
}
