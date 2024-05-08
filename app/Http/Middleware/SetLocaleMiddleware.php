<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocaleMiddleware
{
    public function handle($request, Closure $next)
    {
        if (strpos($request->getRequestUri(), 'livewire') === false) {
            if (!$request->is('api/*')) {
                $locale = $request->segment(1);
                if (!in_array($locale, ['en', 'id'])) {
                    $locale = 'id';
                    $url = url($locale . '/' . ltrim($request->getRequestUri(), '/'));
                    return redirect($url);
                }

                App::setLocale($locale);
                Session::put('locale', $locale);
            }
        }

        return $next($request);
    }
}