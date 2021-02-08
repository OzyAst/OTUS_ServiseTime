<?php

namespace App\Services\BusinessContacts\Repositories;

use App\Models\BusinessContact;
use App\Services\BusinessContacts\DTOs\CreateFormBusinessContactDTO;
use Illuminate\Database\Eloquent\Collection;

class EloquentBusinessContactRepository implements BusinessContactRepositoryInterface
{

    public function find(int $id): ?BusinessContact
    {
        return BusinessContact::find($id);
    }

    public function findByBusinessId(int $business_id): ?Collection
    {
        return BusinessContact::whereBusinessId($business_id)->get();
    }

    public function create(CreateFormBusinessContactDTO $createDTO): ?BusinessContact
    {
        return BusinessContact::create($createDTO->toArray());
    }

    public function update(BusinessContact $model): BusinessContact
    {
        $model->save();
        return $model;
    }

    public function delete(BusinessContact $model): bool
    {
        return $model->delete();
    }
}
