<?php

namespace App\Services\Records;

use App\Models\Record;
use App\Services\Records\Repositories\RecordRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class RecordService
{

    /**
     * @var RecordRepositoryInterface
     */
    private $repository;

    public function __construct(
        RecordRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * Списк всех записей для салона
     * @return Collection|null
     */
    public function getMyRecord(): ?Collection
    {
        if (Auth::guest()) {
            return new Collection();
        }

        return $this->repository->findByBusinessId(Auth::user()->business->id);
    }

    /**
     * Список записей для процедуры
     * @param int $procedure_id
     * @param Carbon|null $date_start
     * @param Carbon|null $date_end
     * @return Collection|null
     */
    public function getProcedureRecords(int $procedure_id, ?Carbon $date_start, ?Carbon $date_end)
    {
        $date_start = $date_start ?? now();
        $date_end = $date_end ?? now()->addDays(Record::GET_RECORDS_FOR_DAYS);

        return $this->repository->findByProcedureId($procedure_id, $date_start, $date_end);
    }
}
