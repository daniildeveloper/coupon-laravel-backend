<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use App\TopAction;

class BannerController extends Controller
{
    public function showBannerSettings()
    {
        $action_top = DB::table("top_actions")->get()[0];
        return view("admin.banner.settings", [
            "banner" => $action_top,
        ]);
    }

    public function updateBanner(Request $request) {
      dd($request);
      DB::table('top_actions')->where('id', 1)->update([
          "image" => \Storage::putFile('company', new File($request->file('preview'))),
          "link" => $request['link']
        ]);
        return redirect()->back();
    }

}
