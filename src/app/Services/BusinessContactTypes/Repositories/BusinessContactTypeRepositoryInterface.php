<?php

namespace App\Services\BusinessContactTypes\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface BusinessContactTypeRepositoryInterface
{
    /**
     * Получить список записей
     * @return mixed
     */
    public function get(): ?Collection;
}
