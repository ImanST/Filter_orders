<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminNotificationExceptionMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private array $data;

    /**
     * Create a new message instance.
     */
    public function __construct(array $data)
    {
        $this->data = $data;
        $this->onQueue('notification::mail');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {

        return $this->subject($this->data['subject'])->view('mail.some_template_email')->with(['data' => $this->data]);
    }
}
