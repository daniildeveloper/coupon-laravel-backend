<?php

namespace App\Http\Controllers;

use App\Company;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \Auth;
use \DB;
use App\Manager;

class SellerController extends Controller
{
    private $sellerId = 1;

    public function __construct()
    {
        if (Auth::user() !== null) {
            $this->sellerId = DB::table('companies')->where('user_id', Auth::user()->id)->get()[0]->id;
        }
    }
    /**
     * show view with company register
     * @return view
     */
    public function showRegisterView()
    {
        return view('seller.register');
    }

    /**
     * register company
     * @param  Request $request data from form
     * @return redirect           redirect to main page
     */
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

        return redirect('/', [
            'alert'        => 'Спасибо за регистрацию. Проверьте вашу почту, туда пришло письмо с подтверждением. В ближайшее время Ваш персональный консультант свяжется с вами по указанным телефонам и ответит на все возникшие вопросы.',
            'alertContext' => 'success',
        ]);
    }

    /**
     * show seller dashboard with main statistics
     * @return view
     */
    public function showSellerDashboard()
    {

        return view('seller.dashboard');
    }

    public function showSellerCoupons()
    {   
        $products = DB::table('coupons')->where('company_id', $this->seller_id)->get();
        return view('seller.coupons', [
            'products' => $products,
        ]);
    }

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

    public function inviteManagers(){
      // todo: send email invation to manager via email
      // if managers email is in system, we have it as manager and give him ops to conversation and coupons CRUD
      // register unknown users
    }

    /**
     * show managers list
     * @return [type] [description]
     */
    public function showManagers(){
      return view('seller.managers', [
          'managers' => Manager::getCompanieManagers($this->sellerId)
        ]);
    }
}
