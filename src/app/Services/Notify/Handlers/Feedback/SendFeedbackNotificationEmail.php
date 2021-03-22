<?php

namespace App\Services\Notify\Handlers\Feedback;

use App\Models\Notify;
use App\Models\User;
use App\Services\Notify\Client\EmailNotifyClient;
use App\Services\Notify\Mail\FeedbackMail;
use App\Services\Notify\Handlers\NotificationInterface;

/**
 * Уведомление пользователю о новом сообщении
 */
class SendFeedbackNotificationEmail implements NotificationInterface
{
    private FeedbackMail $mail;
    private EmailNotifyClient $client;

    public function __construct(
        FeedbackMail $mail,
        EmailNotifyClient $client
    )
    {
        $this->mail = $mail;
        $this->client = $client;
    }

    public function handle($message, User $user)
    {
        $message = $this->mail;
        $this->client->send($message, $user);
    }

    public function getType(): string
    {
        return Notify::EMAIL_TYPE;
    }
}
