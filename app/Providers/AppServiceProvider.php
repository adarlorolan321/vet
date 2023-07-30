<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('app.env') === 'dev') {
            URL::forceScheme('https');
            Request::setTrustedProxies([request()->getClientIp()], Request::HEADER_X_FORWARDED_PROTO);
        }
    }
}
