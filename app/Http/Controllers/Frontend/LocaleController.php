<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Session;

class LocaleController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function __invoke(Request $request, $locale)
    {
        if (!in_array($locale, config('app.available_locales'))) {
            $locale = 'en';
        }
        Session::put('locale', $locale);
        Session::save();
        return redirect(url(URL::previous()));
    }
}
