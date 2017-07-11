<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\PromoCompany as Promo;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    /**
     * create promo action
     * @param  Request $request
     * @return view
     */
    public function createPromo(Request $request)
    {
        $promo                  = new Promo();
        $promo->title           = $request['promo_title'];
        $promo->description     = ["promo_description"];
        $promo->slug            = RUtils::translit()->slugify($request["title"]);
        $promo->preview         = \Storage::putFile("promo", new File($request->file("preview")));
        $promo->availbale_until = Carbon::parse($request["available_until"])->format("Y-m-d H:m:s");
        $promo->save();
    }

    /**
     * update coupon to be available on promo
     * @param int  $id      promo integer
     * @param Request $request
     */
    public function addCouponToPromo($id, Request $request)
    {
        \DB::table("coupons")->where("id", $id)->update([
            "promo_company_id" => $request["promo"],
        ]);
    }

    public function hidePromo($id)
    {
        \DB::table("promo_companies")->where("id", $id)->update([
            "is_show" => 0,
        ]);
    }

    /**
     * publish coupons
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function publishPromo($id)
    {
        \DB::table("promo_companies")->where("id", $id)->update([
            "is_show" => 1,
        ]);
    }

    
}
