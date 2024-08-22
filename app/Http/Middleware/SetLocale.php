<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $preferredLanguage = $request->header('Accept-Language');

        if (in_array($preferredLanguage, ['ar', 'en'])) {
            app()->setLocale($preferredLanguage);
        } else {
            app()->setLocale('ar');
        }

        return $next($request);
    }
}
