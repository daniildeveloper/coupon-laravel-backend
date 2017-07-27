<?php

namespace App\Http\Controllers;

use App\Company;
use App\Manager;
use App\Model\Client;
use App\Model\CouponsCategory;
use App\User;
use App\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \Auth;
use \DB;
use Carbon\Carbon;
use \Storage;
use Illuminate\Http\File;

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
        $products = DB::table('coupons')->where('company_id', $this->sellerId)->get();
        return view('seller.coupons', [
            'products' => $products,
        ]);
    }

    public function showSellerHistory()
    {}

    /**
     * show sellers coupon creation view
     * @return [type] [description]
     */
    public function showSellerCouponCreationView()
    {
        $couponCategories = CouponsCategory::all();
        return view('seller.coupon.new', [
            'couponCategories' => $couponCategories,
        ]);
    }

    public function createCoupon(Request $request)
    {
        $coupon                            = new Coupon();
        $coupon->title                     = $request['title'];
        $coupon->company_id                = $this->sellerId;
        $coupon->description               = $request['content'];
        $coupon->short_description         = $request['short_description'];
        // $coupon->profit_type               = 1;
        // $coupon->profit_all                = $request['clients_profit'];
        $available_until                   = Carbon::parse($request->selectDateTime);
        $coupon->available_until           = $available_until->format("Y-m-d H:m:s");

        // 
        $imagePathString = $request['preview'];
        $imagePathArray = explode('/', $imagePathString);
        $imagePathArray[1] = 'storage';
        $imagePathString = implode('/', $imagePathArray);

        $coupon->image                     =    $imagePathString;
        $coupon->coupon_category              = $request["coupon_category"];
        $coupon->is_show                   = 1;
        if ($request['image1']) {
            $coupon->carousel_1 = Storage::put("company", new File($request->file("image1")));
        }

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
     * show list of all orders
     * @return [type] [description]
     */
    public function showOrders()
    {
        $orders = DB::table('orders')->where('company_id', $this->sellerId)->get();

        // TODO: paginate
        return view('seller.orders', [
            'orders' => $orders,
        ]);
    }

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

    public function inviteManagers()
    {
        // todo: send email invation to manager via email
        // if managers email is in system, we have it as manager and give him ops to conversation and coupons CRUD
        // register unknown users
    }

    /**
     * show managers list
     * @return [type] [description]
     */
    public function showManagers()
    {
        return view('seller.managers', [
            'managers' => Manager::getCompanieManagers($this->sellerId),
        ]);
    }

    public function showClientsList()
    {
        // get clients from database
        $clientsList = Client::getSellersClients($this->sellerId);

        return view('seller.clients', [
            'clients' => $clientsList,
        ]);

    }

    /**
     * check coupons view
     * @return view
     */
    public function confirmCoupon()
    {
        $coupons = DB::table('coupons')->where('company_id', $this->sellerId)->get();
        return view('seller.dealcheck', [
            'coupons' => $coupons,
        ]);
    }

    public function checkCoupon(Request $request)
    {
        // here goes coupons check logic
    }

}
