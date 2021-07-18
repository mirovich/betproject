<?php

namespace App\Http\Middleware;

use App\Providers\TranslationServiceProvider;
use Closure;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->session()->has('locale')) {
            $locale = $request->session()->get('locale');
            \App::setLocale($locale);
        }
        $trans = new TranslationServiceProvider();
        $trans->boot();

        return $next($request);
    }
}
