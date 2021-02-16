<?php

namespace App\Services\Feedback\Jobs;

use App\Services\Feedback\DTOs\FeedbackCreateHandlerDTO;
use App\Services\Feedback\Handlers\FeedbackCreateHandler;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * Сохранение обратной связи от пользователя
 */
class UserFeedback implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    private function getCreateHandler(): FeedbackCreateHandler
    {
        return app(FeedbackCreateHandler::class);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->getCreateHandler()->handle(
            FeedbackCreateHandlerDTO::fromArray($this->data)
        );
    }
}
