<?php

namespace App\Services\Feedback\Repositories;

use App\Models\Feedback;
use App\Services\Feedback\DTOs\FeedbackCreateDTO;

class EloquentFeedbackRepository implements FeedbackRepositoryInterface
{
    public function create(FeedbackCreateDTO $DTO): ?Feedback
    {
        return Feedback::create($DTO->toArray());
    }
}
