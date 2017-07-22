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
        if (Auth::user() === null || Auth::user() != null && count(DB::table('companies')->where('user_id', Auth::user()->id)->get()) === 0) {

            // TODO: alert message
            return redirect()->route('seller.register', [
                'alert'        => 'Заполните анкету продавца. И начинайте рекламировать свои товары и услуги',
                'alertContext' => 'success',
            ]);
        }
    }
}
