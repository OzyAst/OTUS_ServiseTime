<?php

namespace App\Services\Notify\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FeedbackMail extends Mailable
{
    use Queueable, SerializesModels;

    public $from = [['name' => 'serviceTime', 'address' => 'no-reply@serviceTime.ru']];
    public $subject = "У вас новое сообщение";

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.feedback');
    }
}
