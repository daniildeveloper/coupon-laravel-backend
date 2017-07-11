<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CouponController extends Controller
{

    /**
     * get all coupons ordered by view and are avaliable now
     * @return [type] [description]
     */
    public function getAllCoupons()
    {
        $products = DB::table('coupons')->where(
            [
                ["is_show", 1],
                ["available_until_timestamp", '>=', Carbon::now()->timestamp],
            ]
        )->orderBy('views')->get();

        return response()->json($products);
    }

    /**
     * [getPopularCoupons description]
     * @return [type] [description]
     */
    public function getPopularCoupons()
    {
        $products = DB::table('coupons')->where(
            [
                ["is_show", 1],
                ["available_until_timestamp", '>=', Carbon::now()->timestamp],
            ]
        )->orderBy('views')->get();
    }

    /**
     * [updateCouponViews description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function updateCouponViews(Request $request)
    {
        $data = $request->json()->all();

    }
}
