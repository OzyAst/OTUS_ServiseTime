<?php

namespace App\Services\Records\Repositories;

use App\Models\Record;
use App\Services\Records\DTO\RecordCreateHandlerDTO;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class EloquentRecordRepository implements RecordRepositoryInterface
{

    public function find(int $id): ?Record
    {
        return Record::find($id);
    }

    public function findByBusinessId(int $business_id): ?Collection
    {
        return Record::whereBusinessId($business_id)->get();
    }

    public function searchByBusinessId(int $business_id, int $paginate): LengthAwarePaginator
    {
        return Record::whereBusinessId($business_id)->paginate($paginate);
    }

    public function findByBusinessIdInDate(int $business_id, Carbon $date_start, Carbon $date_end): ?Collection
    {
        return Record::whereBusinessId($business_id)
            ->whereDate('date_start', '>=', $date_start)
            ->whereDate('date_start', '<',  $date_end)
            ->get();
    }

    public function findByUserIdInDate(int $user_id, Carbon $date_start, ?Carbon $date_end): ?Collection
    {
        $query = Record::whereClientId($user_id)
            ->whereDate('date_start', '>=', $date_start)
            ->with(['procedure', 'business']);

        if ($date_end) {
            $query->whereDate('date_start', '<',  $date_end);
        }

        return $query->get();
    }

    public function countRecords(int $business_id, $date_start, $date_end): int
    {
        return Record::whereBusinessId($business_id)
            ->whereDate('date_start', '>=', $date_start)
            ->whereDate('date_start', '<=',  $date_end)
            ->count();
    }

    public function countRecordsDone(int $business_id, $date_start, $date_end): int
    {
        return Record::whereBusinessId($business_id)
            ->whereStatus(Record::STATUS_DONE)
            ->whereDate('date_start', '>=', $date_start)
            ->whereDate('date_start', '<=',  $date_end)
            ->count();
    }

    public function sumPriceRecords(int $business_id, $date_start, $date_end): int
    {
        return Record::whereBusinessId($business_id)
            ->whereDate('date_start', '>=', $date_start)
            ->whereDate('date_start', '<=',  $date_end)
            ->where('status', Record::STATUS_DONE)
            ->sum("price");
    }

    public function findByProcedureId(int $procedure_id, Carbon $date_start, Carbon $date_end): ?Collection
    {
        return Record::whereProcedureId($procedure_id)->with('procedure')
            ->where(function ($query) use ($date_start, $date_end) {
                $query->whereBetween('date_start', [$date_start, $date_end])
                    ->orWhereBetween('date_end', [$date_start, $date_end]);
            })
            ->get();

    }

    public function update(Record $record): bool
    {
        return $record->save();
    }

    public function delete(Record $record): bool
    {
        return $record->delete();
    }

    public function create(RecordCreateHandlerDTO $DTO): ?Record
    {
        return Record::create($DTO->toArray());
    }

    public function findByClientIdOrFail(int $id, int $user_id): ?Record
    {
        return Record::where('id', $id)
            ->where('client_id', $user_id)->firstOrFail();
    }

    public function findByBusinessIdOrFail(int $record_id, int $business_id): Record
    {
        return Record::where('id', $record_id)->whereBusinessId($business_id)
            ->firstOrFail();
    }

    public function getPopularProceduresByRecord(int $business_id): ?\Illuminate\Support\Collection
    {
        return DB::table('records', 'r')
            ->select([
                DB::raw('count(*) as count'),
                'p.name as procedure'
            ])
            ->where(['r.business_id' => $business_id])
            ->groupBy('r.procedure_id')
            ->leftJoin('procedures as p', 'r.procedure_id', '=', 'p.id')
            ->orderBy('count', 'DESC')
            ->limit(3)
            ->get();
    }

    public function sumPriceForProcedureGroupWorker(
        int $business_id,
        Carbon $date_start,
        Carbon $date_end
    ): ?\Illuminate\Support\Collection
    {
        return DB::table('records', 'r')
            ->select([
                DB::raw('count(*) as count'),
                DB::raw('SUM(r.price) as sum_price'),
                'p.name as procedure_name',
                'p.price as price',
                'p.id as procedure_id',
            ])
            ->where(['r.business_id' => $business_id, "r.status" => Record::STATUS_DONE])
            ->whereDate('date_start', '>=', $date_start)
            ->whereDate('date_start', '<=',  $date_end)
            ->groupBy('r.procedure_id')
            ->leftJoin('procedures as p', 'r.procedure_id', '=', 'p.id')
            ->orderBy('count', 'DESC')
            ->get();
    }

    public function countStatisticForRecords(
        int $business_id,
        Carbon $date_start,
        Carbon $date_end
    ): ?\Illuminate\Support\Collection
    {
        return DB::table('records', 'r')
            ->select([
                DB::raw('count(*) as count'),
                DB::raw('SUM(r.price) as sum_price'),
                'p.name as procedure_name',
                'p.price as price',
                'p.id as procedure_id',
                'r.status',
            ])
            ->where(['r.business_id' => $business_id])
            ->whereDate('date_start', '>=', $date_start)
            ->whereDate('date_start', '<=',  $date_end)
            ->groupBy('r.procedure_id', 'r.status')
            ->leftJoin('procedures as p', 'r.procedure_id', '=', 'p.id')
            ->orderBy('procedure_id', 'ASC')
            ->orderBy('r.status', 'ASC')
            ->get();
    }

    public function statisticRecordsGroupByClients(
        int $business_id,
        Carbon $date_start,
        Carbon $date_end
    ): ?\Illuminate\Support\Collection
    {
        return DB::table('records', 'r')
            ->select([
                DB::raw('count(*) as count'),
                DB::raw('SUM(r.price) as sum_price'),
                'p.name as procedure_name',
                'p.price as price',
                'p.id as procedure_id',
                'r.client_id as client_id',
                'c.name as client_name',
                'r.status',
            ])
            ->where(['r.business_id' => $business_id])
            ->whereDate('date_start', '>=', $date_start)
            ->whereDate('date_start', '<=',  $date_end)
            ->groupBy('r.client_id', 'r.status')
            ->leftJoin('procedures as p', 'r.procedure_id', '=', 'p.id')
            ->leftJoin('users as c', 'c.id', '=', 'r.client_id')
            ->orderBy('client_id', 'ASC')
            ->orderBy('r.status', 'ASC')
            ->get();
    }

    public function countRecordsByProcedure(int $procedure_id, string $date_start, string $date_end): int
    {
        return Record::whereProcedureId($procedure_id)
            ->where(function ($query) use ($date_start, $date_end) {
                $query->whereBetween('date_start', [$date_start, $date_end])
                    ->orWhereBetween('date_end', [$date_start, $date_end]);
            })
            ->count();
    }
}
