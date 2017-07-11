<?php

namespace App\Http\Controllers;

use App\Company as Seller;
use App\Coupon;
use App\CouponOwner;
use App\Deal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    // public function __construct()
    // {
        // $this->middleware("auth");
    // }

    /**
     * После оплаты в магазине происходит покупка
     * @param $couponId int купон
     * @param $clientId int клиент
     * @param $companyId int компания дающая скидки
     */
    public function buyCoupon($couponId, $clientId, $companyId)
    {
        $deal             = new Deal();
        $deal->coupon_id  = $couponId;
        $deal->client_id  = $clientId;
        $deal->company_id = $companyId;
        $deal->save();
//        todo: interaction with crm

//        теперь у пользователя есть этот купон
        $couponOwnership            = new CouponOwner();
        $couponOwnership->coupon_id = $couponId;
        $couponOwnership->owner_id  = $clientId;
        $couponOwnership->save();
    }

    public function showAllCoupons()
    {
        $coupons = DB::table('coupons')->get();

        return view('coupon.all', [
            'coupons' => $coupons,
        ]);
    }

    
}
