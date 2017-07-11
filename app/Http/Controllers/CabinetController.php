<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CabinetController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function showCabinet()
    {
        if (count(DB::table('companies')->where('user_id', Auth::user()->id)->get())) {
            $company     = DB::table('companies')->where('user_id', Auth::user()->id)->get()[0];
            $couponCodes = DB::table('coupon_codes')->where("company_id", $company->id)->get();
            $myOrders    = DB::table("orders")->where(["user_id" => Auth::user()->id, "status" => 0])->get();
            return view('company.single', [
                'company'     => $company,
                'couponCodes' => $couponCodes,
                "myOrders"    => $myOrders,
            ]);
        } else {
          return redirect()->back();
        }
    }
}
