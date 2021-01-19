<?php

namespace App\Services\Feedback\Handlers;

use App\Models\User;
use App\Services\Feedback\DTOs\FeedbackCreateHandlerDTO;
use App\Services\Feedback\DTOs\FeedbackCreateDTO;
use App\Services\Feedback\Repositories\FeedbackRepositoryInterface;
use App\Services\Notify\Handlers\SendFeedbackNotificationHandler;
use App\Services\Users\Repositories\UserRepositoryInterface;

/**
 * Сохранить форму обратной связи от пользователя
 */
class FeedbackCreateHandler
{
    private FeedbackRepositoryInterface $repository;
    private UserRepositoryInterface $userRepository;
    private SendFeedbackNotificationHandler $notificationHandler;

    public function __construct(
        FeedbackRepositoryInterface $repository,
        UserRepositoryInterface $userRepository,
        SendFeedbackNotificationHandler $notificationHandler
    )
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
        $this->notificationHandler = $notificationHandler;
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

        // Отправим уведомление
        $businessUser = $this->findOwnerBusiness($feedback['business_id']);
        if ($businessUser) {
            $this->notificationHandler->handle("", $businessUser);
        }
    }

    /**
     * Найти id пользователя
     * @param string $email
     * @return int|null
     */
    private function findUserId(string $email): ?int
    {
        // Ищем пользователя
        $user = $this->userRepository->findByEmail($email);
        if ($user) {
            return $user->id;
        }

        return null;
    }

    /**
     * Найти хозяина бизнеса
     * @param int $business_id
     * @return User|null
     */
    private function findOwnerBusiness(int $business_id): ?User
    {
        return $this->userRepository->findOwnerBusiness($business_id);
    }
}
