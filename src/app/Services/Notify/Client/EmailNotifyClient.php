<?php

namespace App\Services\Notify\Client;

use App\Models\User;
use Illuminate\Support\Facades\Mail;

/**
 * Отправка уведомлений на Email
 */
class EmailNotifyClient implements NotifyClientInterface
{
    public function send($message, User $user): bool
    {
        Mail::to($user->email)->send($message);
        return true;
    }
}
