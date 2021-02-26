<?php

namespace App\Http\Controllers;

use App\Http\Requests\Record\ChangeStatusRecordRequest;
use App\Http\Requests\Record\UpdateBusinessRecordRequest;
use App\Models\Record;
use App\Services\Records\RecordService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RecordController extends Controller
{
    private RecordService $recordService;

    public function __construct(
        RecordService $recordService
    )
    {
        $this->recordService = $recordService;
    }

    /**
     * Страница просмотра записей (история)
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $records = $this->recordService->searchUserRecords(Auth::user());
        $proceduresPopular = $this->recordService->getPopularProcedures(Auth::user()->business->id);

        return view('records.index', [
            'records' => $records,
            'proceduresPopular' => $proceduresPopular
        ]);
    }

    /**
     * Страница с деталями записи
     * @param Record $record
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Record $record)
    {
        return view('records.view', [
            'record' => $record,
        ]);
    }

    /**
     * Форма редактирование записи
     * @param Record $record
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Record $record)
    {
        return view('records.edit', [
            'record' => $record,
        ]);
    }

    /**
     * Редактирование записи
     * @param UpdateBusinessRecordRequest $request
     * @param $record_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateBusinessRecordRequest $request, $record_id)
    {
        $this->recordService->updateForBusiness($request->getFormData(), $record_id, Auth::user());
        return Redirect::to(action([self::class, 'index']));
    }

    /**
     * Редактирование статуса записи
     * @param ChangeStatusRecordRequest $request
     * @param $record_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeStatus(ChangeStatusRecordRequest $request, int $record_id)
    {
        $status = $request->getFormData()['status'];
        $this->recordService->changeStatusForBusiness($status, $record_id, Auth::user());
        return Redirect::back();
    }

    /**
     * Отмена записи
     * @param $record_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancel(int $record_id)
    {
        $this->recordService->cancelUserRecord($record_id, Auth::user());
        return Redirect::back();
    }

    /**
     * Удалить запись
     * @param int $record_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $record_id)
    {
        $this->recordService->deleteBusinessRecord($record_id, Auth::user());
        return Redirect::to(action([self::class, 'index']));
    }
}
