<?php

namespace App\Services\Records\Repositories;

use App\Models\Record;
use Illuminate\Database\Eloquent\Collection;

interface RecordRepositoryInterface
{
    /**
     * Найти запись по ID
     * @param int $id
     * @return Record|null
     */
    public function find(int $id): ?Record;

    /**
     * Найти записи по Business ID
     * @param int $business_id
     * @return Collection|null
     */
    public function findByBusinessId(int $business_id): ?Collection;

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
