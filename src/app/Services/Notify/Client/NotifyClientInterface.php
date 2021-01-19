<?php

namespace App\Services\Notify\Client;

use App\Models\User;

interface NotifyClientInterface
{
    /**
     * Отправить уведомление
     * @param $message
     * @param User $user
     * @return bool
     */
    public function send($message, User $user): bool;
}
