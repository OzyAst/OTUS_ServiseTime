<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Record\StoreRecordRequest;
use App\Http\Requests\Record\DateParamsRequest;
use App\Http\Requests\Record\UpdateRecordRequest;
use App\Services\Api\Translators\ApiTranslatorService;
use App\Services\Records\RecordService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RecordController extends Controller
{
    private RecordService $service;
    private ApiTranslatorService $translatorService;

    public function __construct(
        RecordService $service,
        ApiTranslatorService $translatorService
    )
    {
        $this->service = $service;
        $this->translatorService = $translatorService;
    }

    /**
     * Получить расписание для процедуры
     * @param $procedure_id
     * @param DateParamsRequest $request
     * @return JsonResponse
     */
    public function index($procedure_id, DateParamsRequest $request): JsonResponse
    {
        $date = $request->getFormData();
        $date_start = isset($date['date_start']) ? Carbon::parse($date['date_start']) : null;
        $date_end = isset($date['date_end']) ? Carbon::parse($date['date_end']) : null;

        $records = $this->service->getProcedureRecords($procedure_id, $date_start, $date_end);
        $recordsList = $this->translatorService->translateRecordsForCalendar($records);

        return response()->json($recordsList);
    }

    /**
     * Добавление новой записи
     * @param StoreRecordRequest $request
     * @return JsonResponse
     */
    public function store(StoreRecordRequest $request): JsonResponse
    {
        $this->service->createForUser($request->getFormData(), Auth::user());
        return response()->json(["success" => true]);
    }

    /**
     * Детали записи
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $record = $this->service->findRecordUser($id, Auth::user());
        $record = $this->translatorService->translateRecordDetail($record);
        return response()->json(["success" => true, 'record' => $record]);
    }

    /**
     * Обновление записи
     * @param UpdateRecordRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(UpdateRecordRequest $request, $id): JsonResponse
    {
        $this->service->updateForUser($request->getFormData(), $id, Auth::user());
        return response()->json(["success" => true]);
    }

    /**
     * Удалить запись
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $this->service->deleteUserRecord($id, Auth::user());
        return response()->json(["success" => true]);
    }
}
