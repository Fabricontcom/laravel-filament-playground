<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    public function show()
    {
        $locale = session()->get('locale', config('app.locale'));
        App::setLocale($locale);

        //return redirect(url()->current().'/');
        return view('index');
    }
}
