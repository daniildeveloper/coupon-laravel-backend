<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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
        if(\Auth::user() === null || \Auth::user()->role_code === 999) {
            return redirect()->route('login');
        }
        return $next($request);
    }
}
