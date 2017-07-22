<?php

namespace App\Http\Controllers;

use App\Company;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \Auth;

class SellerController extends Controller
{
    /**
     * show view with company register
     * @return view
     */
    public function showRegisterView()
    {
        return view('seller.register');
    }

    public function register(Request $request)
    {
        $userId = 0;

        // register user if isnt logged in. Set user id if is logged in.
        if (!Auth::user()) {
            $this->validatorRegister($request->all())->validate();
            $user           = new User();
            $user->name     = $request['name'];
            $user->password = bcrypt($request['password']);
            $user->email    = $request['email'];
            $user->save();
            $userId = $user->id;
        } else {
            $userId = Auth::user()->id;
        }

        // register seller
        $seller                       = new Company();
        $seller->user_id              = $userId;
        $seller->seller_name          = $request['seller_name'];
        $seller->seller_address       = $request['seller_address'];
        $seller->seller_primary_phone = $request['seller_primary_phone'];
        $seller->seller_second_phone  = $request['seller_second_phone'];
        $seller->seller_company_type  = $request['company_type'];
        $seller->save();

        // TODO: email verfication

        // TODO: redirect to main page with alert
        return redirect('/');
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

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validatorRegister(array $data)
    {
        return Validator::make($data, [
            'name'        => 'required|max:255',
            'email'       => 'required|email|max:255|unique:users',
            'password'    => 'required|min:6|confirmed',
            'seller_name' => 'required|max:255|unique:companies',
        ]);
    }
}
