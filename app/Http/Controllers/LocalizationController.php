<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Http\RedirectResponse;

class LocalizationController extends Controller
{
    public function setLocalization(string $locale)
    {
        $temp = session()->get('locale', config('app.locale'));
        session()->put('locale', $locale);
        App::setLocale($locale);

        return redirect(preg_replace('/\b'.$temp.'\b/', $locale, url()->previous()));
    }
}
