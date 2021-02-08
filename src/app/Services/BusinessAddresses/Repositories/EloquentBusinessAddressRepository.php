<?php

namespace App\Services\BusinessAddresses\Repositories;

use App\Models\BusinessAddress;
use App\Services\BusinessAddresses\DTOs\CreateFormBusinessAddressDTO;
use Illuminate\Database\Eloquent\Collection;

class EloquentBusinessAddressRepository implements BusinessAddressRepositoryInterface
{

    public function find(int $id): ?BusinessAddress
    {
        return BusinessAddress::find($id);
    }

    public function findByBusinessId(int $business_id): ?Collection
    {
        return BusinessAddress::whereBusinessId($business_id)->get();
    }

    public function create(CreateFormBusinessAddressDTO $createDTO): ?BusinessAddress
    {
        return BusinessAddress::create($createDTO->toArray());
    }

    public function update(BusinessAddress $model): BusinessAddress
    {
        $model->save();
        return $model;
    }

//    public function get(): ?Collection
//    {
//        return Business::all();
//    }
//
//    public function search(array $filter = [])
//    {
//        return Business::paginate();
//    }

    public function delete(BusinessAddress $model): bool
    {
        return $model->delete();
    }
}
