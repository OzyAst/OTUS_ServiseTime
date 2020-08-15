<?php

namespace App\Services\BusinessContactTypes\Repositories;

use App\Models\BusinessContactType;
use Illuminate\Database\Eloquent\Collection;

class EloquentBusinessContactTypeRepository implements BusinessContactTypeRepositoryInterface
{
    public function get(): ?Collection
    {
        return BusinessContactType::all();
    }
}
