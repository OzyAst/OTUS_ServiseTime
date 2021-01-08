<?php

namespace App\Http\Controllers;

use App\Http\Requests\Timetable\DateParamsRequest;
use App\Services\Procedures\ProcedureService;
use App\Services\Records\RecordService;
use Carbon\Carbon;

class TimetableController extends Controller
{
    private RecordService $service;
    private ProcedureService $procedureService;

    public function __construct(
        RecordService $service,
        ProcedureService $procedureService
    )
    {
        $this->service = $service;
        $this->procedureService = $procedureService;
    }

    /**
     * AJAX: Получить расписание для процедуры
     * @param $procedure_id
     * @param DateParamsRequest $request
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function index($procedure_id, DateParamsRequest $request)
    {
        $date = $request->getFormData();
        $date_start = $date['date_start'] ? Carbon::parse($date['date_start']) : null;
        $date_end = $date['date_end'] ? Carbon::parse($date['date_end']) : null;

        return $this->service->getProcedureRecords($procedure_id, $date_start, $date_end);
    }
}
