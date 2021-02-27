<?php

namespace App\Services\Records\Repositories;

use App\Models\Record;
use App\Services\Records\DTO\RecordCreateHandlerDTO;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

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
     * Найти запись для бизнеса или вернуть ошибку 404
     * @param int $record_id
     * @param int $business_id
     * @return Record
     */
    public function findByBusinessIdOrFail(int $record_id, int $business_id): Record;

    /**
     * Найти записи по Business ID
     * @param int $business_id
     * @return Collection|null
     */
    public function findByBusinessId(int $business_id): ?Collection;

    /**
     * Найти записи по Business ID c пагинацией
     * @param int $business_id
     * @param int $paginate
     * @return LengthAwarePaginator
     */
    public function searchByBusinessId(int $business_id, int $paginate): LengthAwarePaginator;

    /**
     * Найти записи по Business ID за промежуток времени
     * @param int $business_id
     * @param Carbon $date_start
     * @param Carbon $date_end
     * @return Collection|null
     */
    public function findByBusinessIdInDate(int $business_id, Carbon $date_start, Carbon $date_end): ?Collection;

    /**
     * Найти записи по User ID за промежуток времени
     * @param int $user_id
     * @param Carbon $date_start
     * @param Carbon $date_end
     * @return Collection|null
     */
    public function findByUserIdInDate(int $user_id, Carbon $date_start, ?Carbon $date_end): ?Collection;

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

    /**
     * Получить популярные процедуры по кол-ву записей
     * @param int $business_id
     * @return \Illuminate\Support\Collection|null
     */
    public function getPopularProceduresByRecord(int $business_id): ?\Illuminate\Support\Collection;

    /**
     * Подсчет заработанного на каждую процедуру с группировкой по работнику
     * @param int $business_id
     * @param $date_start
     * @param $date_end
     * @return mixed
     */
    public function sumPriceForProcedureGroupWorker(
        int $business_id,
        Carbon $date_start,
        Carbon $date_end
    ): ?\Illuminate\Support\Collection;

    /**
     * Статистика по записям на каждую процедуру,
     * показывает кол-во завершенных/отмененных/перенесенных записей
     * @param int $business_id
     * @param Carbon $date_start
     * @param Carbon $date_end
     * @return mixed
     */
    public function countStatisticForRecords(
        int $business_id,
        Carbon $date_start,
        Carbon $date_end
    ): ?\Illuminate\Support\Collection;

    /**
     * Статистика по записям на каждого клиента,
     * показывает кол-во завершенных/отмененных/перенесенных записей
     * @param int $business_id
     * @param Carbon $date_start
     * @param Carbon $date_end
     * @return mixed
     */
    public function statisticRecordsGroupByClients(
        int $business_id,
        Carbon $date_start,
        Carbon $date_end
    ): ?\Illuminate\Support\Collection;
}
