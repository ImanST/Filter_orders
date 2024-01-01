<?php

namespace App\Jobs;

use App\Services\sms\SmsSender;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSmsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $recipient;
    private string $message;

    /**
     * Create a new job instance.
     *
     * @param string $recipient
     * @param string $message
     */
    public function __construct(string $recipient, string $message)
    {
        $this->recipient = $recipient;
        $this->message = $message;
        $this->onQueue('notification::sms');
    }

    /**
     * Execute the job.
     */
    public function handle(SmsSender $smsSender): void
    {
        $smsSender->sendDefault($this->recipient, $this->message);
    }
}
