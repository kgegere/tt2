<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Anhskohbo\NoCaptcha\Rules\Captcha;
use Anhskohbo\NoCaptcha\Facades\NoCaptcha;

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
        // if (env('APP_ENV') === 'production') {
        //     URL::forceScheme('https');
        // }
        Validator::extend('captcha', function ($attribute, $value, $parameters, $validator) {
            return NoCaptcha::verifyResponse($value);
        });
    }
}
