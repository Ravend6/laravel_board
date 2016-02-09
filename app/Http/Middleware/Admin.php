<?php

namespace App\Http\Middleware;

use Closure;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $name)
    {
        if (auth()->check() && auth()->user()->name == $name) {
            return $next($request);
        }

        if ($request->ajax()) {
            return \App\Lib\Message::HTTP_403;
        }

        return redirect('/')->with('flash_info', \App\Lib\Message::HTTP_403);
    }
}
