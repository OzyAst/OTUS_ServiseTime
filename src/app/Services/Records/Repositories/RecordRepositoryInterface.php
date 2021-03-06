<?php

namespace App\Services\Records\Repositories;

use App\Models\Record;
use App\Services\Records\DTO\RecordCreateHandlerDTO;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

interface RecordRepositoryInterface
{
    public function create(RecordCreateHandlerDTO $DTO): ?Record;
    public function update(Record $procedure): bool;
    public function delete(Record $procedure): bool;

    /**
     * Найти запись по ID
     * @param int $id
     * @return Record|null
     */
    public function find(int $id): ?Record;

    /**
     * Найти запись клиента или вернуть ошибку 404
     * @param int $id
     * @param int $user_id
     * @return Record|null
     */
    public function findByClientIdOrFail(int $id, int $user_id): ?Record;

    /**
     * Найти записи по Business ID
     * @param int $business_id
     * @return Collection|null
     */
    public function findByBusinessId(int $business_id): ?Collection;

    /**
     * Найти записи по Procedure ID
     * @param int $procedure_id
     * @param $date_start
     * @param $date_end
     * @return Collection|null
     */
    public function findByProcedureId(int $procedure_id, Carbon $date_start, Carbon $date_end): ?Collection;

    /**
     * Кол-во записей за выбраный период
     * @param int $business_id
     * @param $date_start
     * @param $date_end
     * @return int
     */
    public function countRecords(int $business_id, $date_start, $date_end): int;

    /**
     * Кол-во завершенных записей за выбраный период
     * @param int $business_id
     * @param $date_start
     * @param $date_end
     * @return int
     */
    public function countRecordsDone(int $business_id, $date_start, $date_end): int;

    /**
     * Сумма по записям за выбраный период
     * @param int $business_id
     * @param $date_start
     * @param $date_end
     * @return int
     */
    public function sumPriceRecords(int $business_id, $date_start, $date_end): int;
}
