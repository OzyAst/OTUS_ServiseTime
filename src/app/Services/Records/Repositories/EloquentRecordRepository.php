<?php

namespace App\Services\Records\Repositories;

use App\Models\Record;
use Illuminate\Database\Eloquent\Collection;

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
            ->sum("price");
    }
}
