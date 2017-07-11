<?php

namespace App\Http\Controllers\Admin;

use App\ClientsProfitTypes;
use App\Company;
use App\CompanyType;
use App\Coupon;
use App\CouponCategories;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CouponCompanyController extends Controller
{
    public function showCouponCreationForm()
    {
        $coupon_categories = CouponCategories::all();
        $companies         = Company::all();
        $clientsProfit     = ClientsProfitTypes::all();

        return view("admin.coupons.form", [
            'cats'          => $coupon_categories,
            "companies"     => $companies,
            "clientsProfit" => $clientsProfit,
        ]);
    }

    /**
     * Купоны которые  добавляются из админки, не новые. Они сразу публикуются.
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function createCoupon(Request $request)
    {
        $coupon                            = new Coupon();
        $coupon->coupon                    = $request['coupon'];
        $coupon->title                     = $request['coupon'];
        $coupon->company_id                = $request["company"];
        $coupon->description               = $request['content'];
        $coupon->short_description         = $request['content'];
        $coupon->profit_type               = $request["clients_profit_type"];
        $coupon->profit_all                = $request['clients_profit'];
        $available_until                   = Carbon::parse($request->selectDateTime);
        $coupon->available_until           = $available_until->format("Y-m-d H:m:s");
        $coupon->available_until_timestamp = $available_until->timestamp;
        $coupon->image                     = Storage::putFile('company', new File($request->file('preview')));

        if ($request->file("image1") !== null) {
            $coupon->carousel_1 = Storage::put("company", new File($request->file("image1")));
        }
        $coupon->is_show = 1;
        $coupon->is_new  = 0;

        if ($request->file("image2") !== null) {
            $coupon->carousel_2 = Storage::put("company", new File($request->file("image2")));
        }

        if ($request->file("image3") !== null) {
            $coupon->carousel_3 = Storage::put("company", new File($request->file("image3")));
        }

        $coupon->save();
        return redirect()->back();
    }

    public function inviteCompany(Request $request)
    {
        Mail::send("emails.invite", function ($message) use ($request) {
            $message->from("aigul@chiki-chiki.kz", 'Айгуль из Чики Чики');
            $message->sender("aigul@chiki-chiki.kz", 'Айгуль из Чики Чики');

            $message->to($request['email']);

            $message->subject('Приглашение');

            $message->priority(3);
        });
        return redirect()->back();
    }

    public function getCompaniesForAutoComplete(Request $request)
    {
        $companies = \DB::table("companies")->get();

        return response()->json($companies);
    }

    /**
     * [showCompanyTypes description]
     * @return [type] [description]
     */
    public function showCompanyTypes()
    {
        $types = CompanyType::all();
        return view("admin.companies.types", [
            "types" => $types,
        ]);
    }

    public function editCompanyType($id)
    {
        $q = CompanyType::find($id);
        return view("admin.editor", [
            "entity"                       => $q,
            // "previewUrl"                   => "",
            "title"                        => $q->title . " | Редактировать тип компании",
            "route"                        => "companytypes.update",
            "content"                      => $q->description,
            "additional_input_placeholder" => $q->title,
        ]);
    }
    public function udpateCompanyType(Request $request)
    {
        \DB::table("company_types")->where("id", $request->id)->update([
            "description" => $request["text"],
            "title"       => $request["additional_input"],
        ]);
        return redirect()->back();
    }

    public function newCompanyType()
    {
        return view("admin.editor", [
            "title"                        => "Новый тип компании",
            "route"                        => "companytypes.create",
            "content"                      => "",
            "additional_input_placeholder" => "",
        ]);
    }

    public function createCompanyType(Request $request)
    {
        $q              = new CompanyType();
        $q->title       = $request["additional_input"];
        $q->description = $request["text"];
        $q->save();
        return redirect()->route("companytypes");
    }

    /**
     * [deleteCompanyType description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function deleteCompanyType($id)
    {
        DB::table("company_types")->where("id", $id)->delete();
        return redirect()->back();
    }

}
