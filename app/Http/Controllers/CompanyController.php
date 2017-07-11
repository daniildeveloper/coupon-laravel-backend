<?php

namespace App\Http\Controllers;

use App\ClientsProfitTypes;
use App\Coupon;
use App\CouponCategories;
use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('company');
    }

    public function showNewCouponForm()
    {
        $clients_profit    = ClientsProfitTypes::all();
        $coupon_categories = CouponCategories::all();
        return view('coupon.add', [
            'cats'             => $clients_profit,
            "couponCategories" => $coupon_categories,
        ]);
    }

    public function createCoupon(Request $request)
    {

        $userId                            = Auth::user()->id;
        $coupon                            = new Coupon();
        $coupon->coupon                    = $request['coupon'];
        $coupon->title                     = $request['coupon'];
        $coupon->company_id                = DB::table('companies')->where('user_id', $userId)->get()[0]->id;
        $coupon->description               = $request['content'];
        $coupon->short_description         = $request['content'];
        $coupon->profit_type               = 1;
        $coupon->profit_all                = $request['clients_profit'];
        $available_until                   = Carbon::parse($request->selectDateTime);
        $coupon->available_until           = $available_until->format("Y-m-d H:m:s");
        $coupon->image                     = Storage::putFile('company', new File($request->file('preview')));
        $coupon->category_id               = $request["coupon_category"];
        $coupon->available_until_timestamp = $available_until->timestamp;
        $coupon->carousel_1                = Storage::put("company", new File($request->file("image1")));
        $coupon->is_show                   = 0;

        if ($request->file("image2") !== null) {
            $coupon->carousel_2 = Storage::put("company", new File($request->file("image2")));
        }

        if ($request->file("image3") !== null) {
            $coupon->carousel_3 = Storage::put("company", new File($request->file("image3")));
        }

        // if ($request->hasFile('preview')) {
        //     // $file = Input::file;
        // }
        $coupon->save();
        // dd($coupon);
        return redirect()->back();
    }

    /**
     * создает промокомпанию. Все купоны распределяются в определенных промо
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function createPromo(Request $request)
    {

    }

    public function showMyCompany()
    {
        $company     = DB::table('companies')->where('user_id', Auth::user()->id)->get()[0];
        $couponCodes = DB::table('coupon_codes')->where("company_id", $company->id)->get();
        $myOrders    = DB::table("orders")->where(["user_id" => Auth::user()->id, "status" => 0])->get();
        return view('company.single', [
            'company'     => $company,
            'couponCodes' => $couponCodes,
            "myOrders"    => $myOrders,
        ]);
    }

    public function companyDashboard()
    {
        return view("company.dashboard");
    }

}
