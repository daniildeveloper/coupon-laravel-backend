<?php

namespace App\Http\Controllers\Admin;

use App\Model\CouponsCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    /**
     * show editor
     * @return view with content editor [description]
     */
    public function showEditor()
    {
        return view("admin.editor", [
            "title"   => "Тестовый",
            "route"   => "editor",
            "content" => "some content",
        ]);
    }

    /**
     * show all categories
     * @return [type] [description]
     */
    public function showCategories()
    {
        return view("admin.categorie.all", [
            "cats" => CouponsCategory::all(),
        ]);
    }

    public function updateCategory(Request $request, $id) {
        \DB::table('coupons_categories')->where('id', $id)->update([
                'title' => $request['name']
            ]);
        return redirect()->back();
    }
}
