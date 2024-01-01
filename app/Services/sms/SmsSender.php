<?php

namespace App\Services\sms;

interface SmsSender
{
    public function getDriverName(): string;

    // we can use SmsNotification Model to store information in database.
    // instead of using $recipient and $message using model SmsNotification $smsNotification
    public function send(?string $sender, string $recipient, string $message): string;

    // we can use SmsNotification Model to store information in database.
    // instead of using $recipient and $message using model SmsNotification $smsNotification
    public function sendDefault(string $recipient, string $message): string;

    public function getStatus(int $smsId): mixed; // in case store SMS notification in database
}
