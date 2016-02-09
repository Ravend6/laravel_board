<?php

namespace App\Http\Middleware;

use Closure;

class Lang
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
        $lang = $request->lang;
        if (in_array($lang, config('app.list_locales'))) {
            if ($lang == \App::getLocale()) return $next($request);
            \Carbon\Carbon::setLocale($lang);
            \App::setLocale($lang);
        } else {
            abort(404);
        }
        return $next($request);
    }
}
