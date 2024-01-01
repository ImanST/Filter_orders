<?php

namespace App\Services;

use App\Jobs\SendSmsJob;
use App\Mail\AdminNotificationExceptionMail;
use Exception;
use Illuminate\Support\Facades\Mail;

class NotificationService
{
    public function notifyAdminFromException(Exception $exception): void
    {
        $data = [
            'subject' => 'Exception in filtering order',
            'message' => 'Exception Message: ' . $exception->getMessage()
        ];

        Mail::to(strval(config('admin.mail_admin')))->send(new AdminNotificationExceptionMail($data));

        SendSmsJob::dispatch(strval(config('admin.mobile_admin')), 'Exception in filtering order');
    }
}
