<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Company;
use App\Coupon as Product;
use App\CouponCode;
use App\Order;
use App\OrderProduct;
use Epay\Client as KazkomPay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use \Mail;
use Epay;

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
        $email = $request['email'];

        $order            = new Order();
        $order->type      = 2;
        $order->status    = 1;
        $order->user      = $email;
        $order->coupon_id = $id;
        $order->save();

        // todo: send invation link to email

        $orderProduct             = new OrderProduct();
        $orderProduct->order_id   = $order->id; //
        $orderProduct->product_id = $id;
        $order->save();

        $product = Product::find($id);
        $company = Company::find($product->company_id);

        $coupon_code             = new CouponCode();
        $coupon_code->coupon_id  = $id;
        $coupon_code->company_id = Product::find($id)->company_id;
        if (Auth::user() != null) {
            $coupon_code->user_id = Auth::user()->id;
        }
        $coupon_code->code    = rand(1000, 9999);
        $coupon_code->confirm = rand(1000, 9999);
        $coupon_code->client  = $request['email'];
        $coupon_code->save();

        $user_email = "aigul@chiki-chiki.kz";

        $data = [
            'email'      => $request['email'],
            'coupon'     => Product::find($id)->coupon,
            "couponCode" => $coupon_code->id,
            "address"    => $company->address,
            "company"    => $company->name,
        ];
        Mail::send('emails.order', $data, function ($message) use ($request, $data) {
            $message->from("aigul@chiki-chiki.kz", 'Айгуль из Чики Чики');
            $message->sender("aigul@chiki-chiki.kz", 'Айгуль из Чики Чики');

            $message->to($request['email']);

            $message->subject('Купон на скидку');

            $message->priority(3);
        });
        return redirect()->action("WelcomeController@showIndexPage", [
            'alert'     => true,
            "alertText" => "Письмо с кодом купона отправленно к Вам на почту.",
            "alertType" => "success"]);
    }

    public function paySentOrder($user_id = 1, $order_id = 1, $amount = 200)
    {
        $regular_pay = Epay::regularPay([
           'order_id' => rand(111111111111, 999999999999999),
           'currency' => '398',
           'amount' => '50',
           'email'  => 'client@kkb.kz',
           'hashed' => true,
           'reference' => '150218150813'
       ]);

        $xml =  simplexml_load_string($regular_pay->generateUrl());
        $xml_to_array  = json_decode(json_encode((array)$xml), TRUE);

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

        if($payment_array['message'] == "Approved")
        {
            dd( $payment_array);
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
