<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Company;
use App\Coupon as Product;
use App\Deal;
use App\Order;
use App\User;
use Carbon\Carbon;
use Epay\Client as KazkomPay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use \DB;
use \Mail;

class ShoppingCartController extends Controller
{
    /**
     * show all wares
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showShopIndex()
    {
        $products = Product::all();
        return view("shop.index", [
            "products" => $products,
        ]);
    }

    /**
     * add item to cart
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addToCart(Request $request, $id)
    {
        $product = Product::find($id);
        $oldCart = Session::has("cart") ? Session::get("cart") : null;
        $cart    = new Cart($oldCart);
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);
        return redirect()->back();
    }

    public function incrementItemInCart(Request $request, $id)
    {
        $this->addToCart($request, $id);

        return redirect()->back();

    }

    public function decrementItemInCart(Request $request, $id)
    {
        $product = Product::find($id);
        $oldCart = Session::has("cart") ? Session::get("cart") : null;
        $cart    = new Cart($oldCart);
        $cart->removeFromCart($product, $product->id);

        $request->session()->put('cart', $cart);
        return redirect()->back();

    }

    public function showCart()
    {
//        dd(Session::get("cart"));
        return view("shop.cart");
    }

    public function checkout(Request $request)
    {
        return view("shop.checkout", [
            "sum"      => $request["sum"],
            "order_id" => $request["order_id"],
        ]);
    }

    /**
     * смотрим чек к оплате
     * @param  integer $id id
     * @return view     возвращаем просмотр
     */
    public function showOrder($id)
    {
        $order = Order::find($id);
        if ($order === null) {
            return redirect()->route("home", [
                'alert'     => true,
                'alertType' => 'danger',
                'alertText' => 'Заказ не найден.',
            ]);
        }
        return view('order', [
            'order' => $order,
        ]);
    }

    public function createOrderWithoutReg(Request $request, $id)
    {
        $coupon  = count(DB::table('coupons')->where('id', $id)->get()) > 0 ? DB::table('coupons')->where('id', $id)->get()[0] : redirect('/');
        $company = Company::find($coupon->company_id);

        $deal                  = new Deal();
        $deal->coupon_id       = $id;
        $deal->company_id      = $company->id;
        $deal->user_email      = $request['email'];
        $deal->user_code       = rand(10000, 99999);
        $deal->company_code    = rand(10000, 99999);
        $deal->expiration_date = Carbon::now()->addWeeks(2);
        $deal->save();

        $data = [
            'email'   => $request['email'],
            'coupon'  => Product::find($id),
            "address" => $company->seller_address,
            "company" => $company->seller_name,
            "phones"  => [
                $company->seller_primary_phone,
                $company->seller_second_phone,
            ],
            'deal'    => $deal,
        ];
        Mail::send('email.order', $data, function ($message) use ($request, $data) {
            $message->from(env('SUPPORT_EMAIL'), env('SUPPORT_NAME'));
            $message->sender(env('SUPPORT_EMAIL'), env('SUPPPORT_NAME'));

            $message->to($request['email']);

            $message->subject('Купон на скидку');

            $message->priority(3);
        });
        return redirect()->back();
    }

    public function paySentOrderOld($user_id = 1, $order_id = 1, $amount = 200)
    {
        $client = new KazkomPay([
            'MERCHANT_CERTIFICATE_ID' => '00c182b189',
            'MERCHANT_NAME'           => 'Demo Shop',
            'PRIVATE_KEY_FN'          => '/var/www/laravel/vendor/kolesa-team/qazkom-epay/tests/data/cert.prv',
            'PRIVATE_KEY_PASS'        => 'nissan',
            'PRIVATE_KEY_ENCRYPTED'   => 1,
            'XML_TEMPLATE_FN'         => '/var/www/laravel/vendor/kolesa-team/qazkom-epay/tests/data/template.xml',
            'XML_TEMPLATE_CONFIRM_FN' => '/var/www/laravel/vendor/kolesa-team/qazkom-epay/tests/data/template-confirm.xml',
            'PUBLIC_KEY_FN'           => '/var/www/laravel/vendor/kolesa-team/qazkom-epay/tests/data/kkbca-test.pub',
            'MERCHANT_ID'             => '92061101',
        ]);
        $xml = $client->processRequest(time(), $client->getCurrencyId('KZT'), 555);

        return view("pay");
    }

    public function checkoutUserCart(Request $request)
    {
        $cart      = $request['cart'];
        $cart      = unserialize(base64_decode($cart));
        $userEmail = $request['user_email'];

        // if user isnt registred here at any time
        // if (Auth::user() === null && count(DB::table('users')->where('email', $request['user_email'])->get()) === 0) {
        //     // create custom password for user
        //     $generatedPassword = uniqid();

        //     // register new user
        //     $user           = new User();
        //     $user->email    = $userEmail;
        //     $user->name     = $request['user_name'];
        //     $user->password = bcrypt($generatedPassword);
        //     $user->save();

        //     $data = [
        //         'email'    => $request['email'],
        //         'password' => $generatedPassword,
        //     ];

        //     // TODO: create job to send email
        //     Mail::send('email.welcome', $data, function ($message) use ($request, $data) {
        //         $message->from(env('SUPPORT_EMAIL'), env('SUPPORT_NAME'));
        //         $message->sender(env('SUPPORT_EMAIL'), env('SUPPPORT_NAME'));

        //         $message->to($request['email']);

        //         $message->subject('Новая учетная запись');

        //         $message->priority(3);

        //     });

        // }
        
        // here from deals 
        $dealMailingData = [];

        // deserialize
        foreach ($cart as $key) {
            $couponId = $key['id'];
            
            // create new deal
            $deal                  = new Deal();
            $deal->coupon_id       = $id;
            $deal->company_id      = $company->id;
            $deal->user_email      = $request['user_email'];
            $deal->user_code       = rand(10000, 99999);
            $deal->company_code    = rand(10000, 99999);
            $deal->expiration_date = Carbon::now()->addWeeks(2);
            $deal->save();

            $forMailingToUser = array(
                    'coupon_id' => $id,
                );
        }
        dd($cart);
    }

}
