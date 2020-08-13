<?php


namespace App\Http\Controllers;


use App\Services\Statistic\StatisticService;

class StatisticController extends Controller
{
    /**
     * @var StatisticService
     */
    private $service;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(StatisticService $service)
    {
        $this->service = $service;
    }

    /**
     * Статистика
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $statistic = $this->service->getStatusMonth();
        return view('statistic.index', [
            'statistic' => $statistic
        ]);
    }
}
