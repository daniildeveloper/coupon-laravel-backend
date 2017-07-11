<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\SystemSettings as S;
use DB;
use Illuminate\Http\Request;

class SystemSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware("admin");
    }

    /**
     * [showAll description]
     * @return [type] [description]
     */
    public function showAll()
    {
        return view("admin.settings.all", [
            "settings" => S::all(),
        ]);
    }

    /**
     * [updateSetting description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function updateSetting(Request $request)
    {
        // dd($request);
        DB::table("system_settings")->where("id", $request["id"])->update(["value" => $request["setup"]]);
        return redirect()->back();
    }
}
