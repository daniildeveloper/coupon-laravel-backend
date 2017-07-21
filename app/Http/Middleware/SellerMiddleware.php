<?php

namespace App\Http\Middleware;

use Closure;
use \Auth;
use \DB;

class SellerMiddleware
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
        if (Auth::user() === null) {
            return redirect("/login");
        } elseif (Auth::user() != null && count(DB::table('companies')->where('user_id', Auth::user()->id)->get()) === 0) {
            return redirect()->route('seller.register');
        }
    }
}
