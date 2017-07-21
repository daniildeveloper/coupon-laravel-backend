<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function showRegisterView()
    {
        return view('seller.register');
    }

    public function register(Request $request)
    {

    }

    public function showSellerDashboard()
    {}

    public function showSellerCoupons()
    {}

    public function showSellerHistory()
    {}

    public function showSellerCouponCreationView()
    {}

    public function createCoupon(Request $request)
    {}

    public function showOrders()
    {}
}
