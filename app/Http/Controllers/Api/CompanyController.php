<?php

namespace App\Http\Controllers\Api;

use DB;
use App\Company;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * get company by id
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getCompanieById(Request $request)
    {
        $id      = $requst->json()->all()["id"];
        $company = Company::find($id);

        return response()->json((array) $company);
    }

    /**
     * get another company coupons
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function anotherCompaniesCoupons(Request $request)
    {
        $id      = $requst->json()->all()["id"];
        $coupons = DB::table("coupons")->where("company_id", $id)->get();
        return response()->json($coupons);
    }
    
}
