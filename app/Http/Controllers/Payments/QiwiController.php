<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use FintechFab\QiwiSdk\Curl;
use FintechFab\QiwiSdk\Gateway;
use Illuminate\Http\Request;

/**
 * Integration with payments
 */
class QiwiController extends Controller
{   
    private $gateRoute = '';
    /**
     * configuration array
     * @var array
     */
    private $config = array(
        'gateUrl'  => '/pay/qiwi/gate',
        'provider' => array(
            'id'       => 'your-qiwi-gate-id', //логин в системе QIWI
            'password' => 'your-qiwi-gate-password', //пароль в системе QIWI
            'key'      => 'your-qiwi-gate-key', //ключ для подписи в QIWI
        ),
    );
    private $curl;

    /**
     * constructor
     */
    public function __construct()
    {
        Gateway::setConfig($this->config);
        $this->curl = new Curl();
        $this->gateRoute = route('pay.qiwi.gateurl');
    }

    /**
     * create order
     * @param  Request $request
     * @return [type]           [description]
     */
    public function createOrder(Request $request)
    {
        $gate        = new Gateway($curl);
        $billCreated = $gate->createBill(
            $request['orderId'], // номер заказа (счета) в вашей системе
            $request['client_id'], // номер кошелька киви (моб. тел. плательщика)
            $request['total'], // сумма счета
            $request['comment'], // комментрий к счету
            60 * 60 * 24// на сутки
        );
        // TODO: successfull payments order creation view
        // TODO: create job to check if payment is checked
        return redirect('/');
    }

    /**
     * check order
     * @param  [type] $orderId [description]
     * @return [type]          [description]
     */
    public function checkOrder($orderId)
    {
        // проверить статус по номеру заказа (счета)
        $gate          = new Gateway($curl);
        $statusChecked = $gate->doRequestBillStatus($orderId);
        if ($statusChecked) {
            $status = $gate->getValueBillStatus();
            switch ($status) {
                case 'payable': // ожидает оплаты
                case 'paid': // оплачен
                case 'canceled': // отменен
                case 'expired': // отменен, просрочен
            }
        }
    }

    /**
     * reject payment by order
     * @param  [type] $orderId [description]
     * @return [type]          [description]
     */
    public function reject($orderId)
    {
        // отменить счет по номеру заказа (счета)
        $gate         = new Gateway($curl);
        $billCanceled = $gate->cancelBill($orderId);
    }

}
