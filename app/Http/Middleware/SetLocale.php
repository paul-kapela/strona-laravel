<?php

namespace App\Http\Middleware;

use Closure;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        if (request('change_language')) {
            session()->put('language', request('change_language'));

            $language = request('change_language');
        } elseif (session('language')) {
            $language = session('language');
        } elseif (request()->getPreferredLanguage()) {
            $language = request()->getPreferredLanguage();
        } elseif (config('app.locale')) {
            $language = config('app.locale');
        }

        if (isset($language) && config('app.languages.' . $language))
        {
            app()->setLocale($language);
        }

        return $next($request);
    }
}
