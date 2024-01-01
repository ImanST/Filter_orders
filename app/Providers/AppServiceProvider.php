<?php

namespace App\Providers;

use App\Services\sms\SmsSender;
use App\Services\sms\SomePlatformSmsSender;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            SmsSender::class,
            SomePlatformSmsSender::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
