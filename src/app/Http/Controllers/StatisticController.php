<?php


namespace App\Http\Controllers;


use App\Services\Statistic\DTO\DateIntervalDTO;
use App\Services\Statistic\StatisticService;
use Illuminate\Support\Facades\Auth;

class StatisticController extends Controller
{
    private StatisticService $statisticService;

    public function __construct(
        StatisticService $statisticService
    ) {
        $this->statisticService = $statisticService;
    }

    /**
     * Статистика
     * @return \Illuminate\Contracts\Support\Renderable
     * @throws \Exception
     */
    public function index()
    {
        $statistic = $this->statisticService->getStatusMonth(Auth::user()->business->id);
        return view('statistic.index', [
            'statistic' => $statistic,
        ]);
    }

    /**
     * Статистика по зарплате
     */
    public function salary()
    {
        $interval = DateIntervalDTO::fromArray([
            'date_start' => $_GET['date_start'] ?? null,
            'date_end' => $_GET['date_end'] ?? null,
        ]);
        $statistic = $this->statisticService->statisticSalaryForInternal(Auth::user()->business->id, $interval);

        return view('statistic.salary', [
            'date_start' => $interval->date_start,
            'date_end' => $interval->date_end,
            'statistic' => $statistic,
        ]);
    }

    /**
     * Статистика по записям
     */
    public function records()
    {
        $interval = DateIntervalDTO::fromArray([
            'date_start' => $_GET['date_start'] ?? null,
            'date_end' => $_GET['date_end'] ?? null,
        ]);
        $statistic = $this->statisticService->statisticRecordsForInternal(Auth::user()->business->id, $interval);

        return view('statistic.records', [
            'date_start' => $interval->date_start,
            'date_end' => $interval->date_end,
            'statistic' => $statistic,
        ]);
    }

    /**
     * Статистика по клиентам
     */
    public function clients()
    {
        $interval = DateIntervalDTO::fromArray([
            'date_start' => $_GET['date_start'] ?? null,
            'date_end' => $_GET['date_end'] ?? null,
        ]);
        $statistic = $this->statisticService->statisticClientsForInternal(Auth::user()->business->id, $interval);

        return view('statistic.clients', [
            'date_start' => $interval->date_start,
            'date_end' => $interval->date_end,
            'statistic' => $statistic,
        ]);
    }


}
