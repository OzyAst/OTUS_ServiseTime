<?php

namespace App\Services\Feedback\Handlers;

use App\Services\Feedback\DTOs\FeedbackCreateHandlerDTO;
use App\Services\Feedback\DTOs\FeedbackCreateDTO;
use App\Services\Feedback\Repositories\FeedbackRepositoryInterface;
use App\Services\Users\Repositories\UserRepositoryInterface;

/**
 * Сохранить форму обратной связи от пользователя
 */
class FeedbackCreateHandler
{
    private FeedbackRepositoryInterface $repository;
    private UserRepositoryInterface $userRepository;

    public function __construct(
        FeedbackRepositoryInterface $repository,
        UserRepositoryInterface $userRepository
    )
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
    }

    public function handle(FeedbackCreateHandlerDTO $data)
    {
        $feedback = $data->toArray();
        $feedback['user_id'] = $this->findUserId($feedback['email']);

        if (!$feedback['user_id']) {
            $feedback['ip'] = "";
        }

        // Сохраняем фидбэк
        $handleDTO = FeedbackCreateDTO::fromArray($feedback);
        $this->repository->create($handleDTO);
    }

    /**
     * Найти id пользователя
     * @param string $email
     * @return int|null
     */
    private function findUserId(string $email)
    {
        // Ищем пользователя
        $user = $this->userRepository->findByEmail($email);
        if ($user) {
            return $user->id;
        }

        return null;
    }
}
