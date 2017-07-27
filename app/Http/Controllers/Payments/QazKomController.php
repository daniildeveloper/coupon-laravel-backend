<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use Epay\Client;

class QazKomController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = new \Epay\Client(array(
            'MERCHANT_CERTIFICATE_ID' => config('epay.MERCHANT_CERTIFICATE_ID'),
            'MERCHANT_NAME'           => config('epay.MERCHANT_NAME'),
            'PRIVATE_KEY_FN'          => config('epay.PRIVATE_KEY_FN'),
            'PRIVATE_KEY_PASS'        => config('epay.PRIVATE_KEY_PASS') ,
            'PRIVATE_KEY_ENCRYPTED'   => 1,
            'XML_TEMPLATE_FN'         => config('epay.XML_TEMPLATE_FN'),
            'XML_TEMPLATE_CONFIRM_FN' => config('epay.XML_TEMPLATE_CONFIRM_FN') ,
            'PUBLIC_KEY_FN'           => config('epay.PUBLIC_KEY_FN'),
            'MERCHANT_ID'             => config('epay.MERCHANT_ID') ,
        ));
    }

    public function pay() {
      $signature = $this->client->processRequest(1, $this->client->getCurrencyId('KZT'), 500);
      return view('pay.qazkom', [
          "xml" => $signature,
          "orderId" => 1
        ]);
    }
}
