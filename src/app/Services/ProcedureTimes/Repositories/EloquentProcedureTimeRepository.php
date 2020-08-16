<?php

namespace App\Services\ProcedureTimes\Repositories;

use App\Models\ProcedureTime;
use App\Services\ProcedureTimes\DTOs\CreateFormProcedureTimeDTO;
use Illuminate\Database\Eloquent\Collection;

class EloquentProcedureTimeRepository implements ProcedureTimeRepositoryInterface
{

    public function find(int $id): ?ProcedureTime
    {
        return ProcedureTime::find($id);
    }

    public function findByBusinessId(int $business_id): ?Collection
    {
        return ProcedureTime::whereBusinessId($business_id)->get();
    }

    public function create(CreateFormProcedureTimeDTO $createDTO): ?ProcedureTime
    {
        return ProcedureTime::create($createDTO->toArray());
    }

    public function update(ProcedureTime $model): ProcedureTime
    {
        $model->save();
        return $model;
    }

    public function delete(ProcedureTime $model): bool
    {
        return $model->delete();
    }

    public function getTimeDefault(int $business_id): ?Collection
    {
        return ProcedureTime::whereBusinessId($business_id)
            ->whereNull("procedure_id")
            ->get();
    }
}
