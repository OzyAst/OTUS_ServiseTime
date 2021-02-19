<?php

namespace App\Http\Controllers;

use App\Services\Records\RecordService;
use App\Services\Statistic\StatisticService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    private RecordService $recordService;
    private StatisticService $statisticService;

    public function __construct(
        RecordService $recordService,
        StatisticService $statisticService
    )
    {
        $this->recordService = $recordService;
        $this->statisticService = $statisticService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->business) {
                return redirect('/home/business');
            } else {
                return redirect('/home');
            }
        }

        return view('home.landing');
    }

    /**
     * Главная страница, зарегистрированный пользователь
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home()
    {
        $myRecords = $this->recordService->getRecordsForUserInDate(
            Auth::user()->id,
            Carbon::today(),
            Carbon::tomorrow()
        );

        return view('home.index', [
            'myRecords' => $myRecords,
        ]);
    }

    /**
     * Главная страница бизнеса
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function business()
    {
        if (!Auth::user()->business) {
            return redirect('/business/create');
        }

        $statisticToday = $this->statisticService->getStatusToday();
        $records = $this->recordService->getRecordsForBusinessInDate(
            Auth::user()->business->id,
            Carbon::today(),
            Carbon::tomorrow()
        );

        return view('home.business', [
            'records' => $records,
            'statistic' => $statisticToday,
        ]);
    }
}
