<?php

namespace App\Http\Controllers\Admin;

use App\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentsController extends Controller
{
    public function showLast()
    {

        return view('admin.payments.all', [
            "payments" => DB::table("payments")->orderBy('id', 'desc')->paginate(30),
        ]);
    }

    public function showSettings()
    {

        return view('admin.payments.settings', [
            'to_top'      => $this->findData('to_top'),
            'pro_month'   => $this->findData('pro_month'),
            'pro_3_month' => $this->findData('pro_3_month'),
            'pro_6_month' => $this->findData('pro_6_month'),
        ]);
    }

    public function changeData(Request $request)
    {
        $this->updateData('to_top', $request['to_top']);
        $this->updateData('pro_month', $request['pro_month']);
        $this->updateData('pro_3_month', $request['pro_3_month']);
        $this->updateData('pro_6_month', $request['pro_6_month']);
        return redirect()->back();
    }

    private function updateData($slug, $data)
    {
        DB::table('accounting_datas')->where('slug', $slug)->update([
            "value" => $data,
        ]);
    }

    private function findData($slug)
    {
        return DB::table('accounting_datas')->where('slug', $slug)->get()[0]->value;
    }

    /**
     * find payment by id
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function findPayment(Request $request) {
        $id = $request['id'];
        $payment = Payment::find($id);
        $payments = [];
        if ($payment != null) {
            $payments[] = $payment;
        }
        return view("admin.payments.all", [
                "payments" => $payments
            ]);
    }
}
