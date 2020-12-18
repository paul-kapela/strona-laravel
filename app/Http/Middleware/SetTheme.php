<?php

namespace App\Http\Middleware;

use Closure;

class SetTheme
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (request('change_theme')) {
            session()->put('theme', request('change_theme'));
        }

        return $next($request);
    }
}
