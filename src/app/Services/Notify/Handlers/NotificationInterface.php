<?php

namespace App\Services\Notify\Handlers;

use App\Models\User;

interface NotificationInterface
{
    public function handle($message, User $user);

    /**
     * Тип отправки [email, slack, telegram...]
     * @return string
     */
    public function getType(): string;
}
