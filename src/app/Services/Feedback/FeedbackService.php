<?php

namespace App\Services\Feedback;

use App\Services\Feedback\Jobs\UserFeedback;

class FeedbackService
{
    /**
     * Сохранить форму обратной связи
     * @param array $data
     */
    public function create(array $data): void
    {
        UserFeedback::dispatch($data);
    }
}
