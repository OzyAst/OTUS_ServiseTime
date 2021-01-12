<?php

namespace App\Http\Controllers;

use App\Http\Requests\Feedback\StoreFeedbackRequest;
use App\Services\Feedback\FeedbackService;
//use Illuminate\Support\Facades\App;

class FeedbackController extends Controller
{
    private FeedbackService $service;

    public function __construct(
        FeedbackService $service
    )
    {
        $this->service = $service;
    }

    /**
     * Обратная связь
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('feedback.index');
    }

    /**
     * Добавление записи
     * @param StoreFeedbackRequest $request
     * @return mixed
     */
    public function store(StoreFeedbackRequest $request)
    {
        $this->service->create($request->getFormData());
        return app::make('redirect')->back();
    }
}
