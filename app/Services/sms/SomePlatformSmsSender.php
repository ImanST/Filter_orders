<?php

namespace App\Services\sms;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class SomePlatformSmsSender implements SmsSender
{
    public const DRIVER_NAME = "SOME_PLATFORM";

    private Client $client;
    private string $NUMBER;
    private string $USERNAME;
    private string $PASSWORD;

    public function __construct()
    {
        $this->client = new Client();
        $this->NUMBER = strval(config('sms.some_platform.number'));
        $this->USERNAME = strval(config('sms.some_platform.username'));
        $this->PASSWORD = strval(config('sms.some_platform.password'));
    }

    public function getDriverName(): string
    {
        return self::DRIVER_NAME;
    }

    // we can use SmsNotification Model to store information in database.
    // instead of using $recipient and $message using model SmsNotification $smsNotification
    public function send(?string $sender, string $recipient, string $message): string
    {
        Log::info('SMS has been sent.');
        return;
    }

    /**
     * @param string $recipient
     * @param string $message
     * @return string
     */
    // we can use SmsNotification Model to store information in database.
    // instead of using $recipient and $message using model SmsNotification $smsNotification
    public function sendDefault(string $recipient, string $message): string
    {
        return $this->send($this->NUMBER, $recipient, $message);
    }

    /**
     * @param int|string $smsId
     * @return string
     */
    public function getStatus(int|string $smsId): string
    {
        // in case store SmsNotification Model in database
        Log::info('Got SMS status and update model SmsNotification.');
        return;
    }
}
