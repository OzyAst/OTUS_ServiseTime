<?php

namespace App\Services\Notify\Handlers;

use App\Models\User;
use App\Services\Notify\Handlers\Feedback\SendFeedbackNotificationEmail;

/**
 * Уведомление об обратной связи
 */
class SendFeedbackNotificationHandler
{
    /**
     * Доступные типы уведомления
     * @var array
     */
    private array $notificationsAvailable = [
        SendFeedbackNotificationEmail::class
    ];

    public function handle($message, User $user) {
        /**
         * @var NotificationInterface $handler
         */
        foreach ($this->getNotificationsAvailable() as $handler) {
            // проверяем включен ли такой тип уведомления у пользователя
            // $class->getType()
            // если включен отправляем сообщение
            $handler->handle($message, $user);
        }
    }

    /**
     * Вернет правила прогрева по очередно
     * @return iterable
     */
    private function getNotificationsAvailable(): iterable
    {
        foreach ($this->notificationsAvailable as $class) {
            yield app($class);
        }
    }
}
