<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProcedureTime\StoreProcedureTimeRequest;
use App\Http\Requests\ProcedureTime\UpdateProcedureTimeRequest;
use App\Models\Procedure;
use App\Services\ProcedureTimes\ProcedureTimeService;
use App\Services\Week\Week;
use Illuminate\Support\Facades\Redirect;

class ProcedureTimeController extends Controller
{
    /**
     * @var ProcedureTimeService
     */
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param ProcedureTimeService $service
     */
    public function __construct(
        ProcedureTimeService $service
    )
    {
        $this->service = $service;
    }

    /**
     * Страница добавления записи
     * @param Procedure $procedure
     * @return \Illuminate\Contracts\View\Factory | \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create(Procedure $procedure)
    {
        if ($procedure->times->count()) {
            return Redirect::to(action([self::class, 'edit'], ['procedure' => $procedure->id]));
        }

        $timeDefault = $this->service->getTimeBusiness();
        return view('procedure-time.create', [
            'times' => $timeDefault,
            'days' => Week::getWeeks(),
            'procedure' => $procedure,
        ]);
    }

    /**
     * Добавление записи
     * @param StoreProcedureTimeRequest $request
     * @return mixed
     */
    public function store(StoreProcedureTimeRequest $request)
    {
        $this->service->create($request->getFormData());
        return Redirect::to(action([ProcedureController::class, 'index']));
    }

    /**
     * Форма редактирование записи
     * @param Procedure $procedure
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Procedure $procedure)
    {
        $times = $procedure->times;
        return view('procedure-time.edit', [
            'times' => $times,
            'days' => Week::getWeeks(),
        ]);
    }

    /**
     * Редактирование записи
     * @param UpdateProcedureTimeRequest $request
     * @param Procedure $procedure
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateProcedureTimeRequest $request, Procedure $procedure)
    {
        $this->service->update($request->getFormData(), $procedure);
        return Redirect::to(action([ProcedureController::class, 'index']));
    }
}
