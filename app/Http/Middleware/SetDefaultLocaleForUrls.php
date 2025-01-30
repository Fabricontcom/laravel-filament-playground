<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class SetDefaultLocaleForUrls
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $locale = session()->get('locale', config('app.locale'));
        //dd($request->session());
        URL::defaults(['locale' => $locale]);
        App::setLocale($locale);

        //URL::defaults(['locale' => $request->user()->locale ?? config('app.locale')]);
        //App::setLocale($request->user()->locale);

        return $next($request);
    }
}
