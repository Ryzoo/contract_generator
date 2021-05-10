<?php


namespace App\Http\Middleware;


use Illuminate\Support\Facades\App;
use Closure;
use Illuminate\Support\Facades\Session;

class Language
{
    public function handle($request, Closure $next)
    {
        $locale=Session::get('locale', 'pl');
        App::setLocale($locale);
        return $next($request);
    }
}