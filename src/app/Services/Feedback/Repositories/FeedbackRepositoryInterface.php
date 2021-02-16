<?php

namespace App\Services\Feedback\Repositories;

use App\Models\Feedback;
use App\Services\Feedback\DTOs\FeedbackCreateDTO;

interface FeedbackRepositoryInterface
{
    public function create(FeedbackCreateDTO $DTO): ?Feedback;
}
