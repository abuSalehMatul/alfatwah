<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    private $url;

    public function __construct(UrlGenerator $url)
    {
        $this->url = $url;
    }

    public function handle($request, Closure $next)
    {
        $defaultLocale = Session::get("APP_LOCALE")??config('app.locale');
       
        $APP_LOCALE = $request->segment(1) ?? $defaultLocale;
       
        app()->setLocale($APP_LOCALE);

        $this->url->defaults(['locale' => $APP_LOCALE]);

        
        view()->share('APP_LOCALE', $APP_LOCALE);
        Session::put('APP_LOCALE', $APP_LOCALE);
       // dd(Session::get("APP_LOCALE"));
        return $next($request);
    }
}
