<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Company;
use App\Coupon as Product;
use App\Deal;
use App\Order;
use Epay;
use Epay\Client as KazkomPay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use \Mail;
use Carbon\Carbon;
use \DB;

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
            'email'      => $request['email'],
            'coupon'     => Product::find($id),
            "address"    => $company->seller_address,
            "company"    => $company->seller_name,
            "phones" => [
                $company->seller_primary_phone,
                $company->seller_second_phone
            ],
            'deal'       => $deal,
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

    public function paySentOrder($user_id = 1, $order_id = 1, $amount = 200)
    {
        $regular_pay = Epay::regularPay([
            'order_id'  => rand(111111111111, 999999999999999),
            'currency'  => '398',
            'amount'    => '50',
            'email'     => 'client@kkb.kz',
            'hashed'    => true,
            'reference' => '150218150813',
        ]);

        $xml          = simplexml_load_string($regular_pay->generateUrl());
        $xml_to_array = json_decode(json_encode((array) $xml), true);

        // check american express card

        // if (array_key_exists('@attributes', $xml_to_array['error']))
        // {
        //     if ($xml_to_array['error']['@attributes']['input'] != null ||
        //         $xml_to_array['error']['@attributes']['payment'] != null ||
        //         $xml_to_array['error']['@attributes']['system'] != null
        //     )
        //     {
        //        dd(  $xml_to_array['error']['@attributes']);
        //     }
        // }

        $payment_array = $xml_to_array['payment']['@attributes'];
        dd($payment_array);

        if ($payment_array['message'] == "Approved") {
            dd($payment_array);
        }

        dd(false);
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

}
