<?php

namespace App\Http\Middleware;

use Closure;

class Dashboard
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
        if ($request->is('dashboard') or $request->is('dashboard/*')) {
            if(auth()->check() && auth()->user()->name == 'root') {
                return $next($request);
            } else {
                return redirect('/')->with('flash_info', \App\Lib\Message::HTTP_403);
            }

        } else {
            return $next($request);
        }
    }
}
