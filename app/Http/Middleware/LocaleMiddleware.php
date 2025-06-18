<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LocaleMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!session()->has('locale')) {
            $acceptLang = $request->server('HTTP_ACCEPT_LANGUAGE');
            if ($acceptLang) {
                $locale = substr($acceptLang, 0, 2);
                if (in_array($locale, ['en', 'lv'])) {
                    session(['locale' => $locale]);
                    app()->setLocale($locale);
                }
            }
        } else {
            app()->setLocale(session('locale'));
        }
        return $next($request);
    }
}
