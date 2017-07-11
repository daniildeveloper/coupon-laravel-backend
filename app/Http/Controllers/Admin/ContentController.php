<?php

namespace App\Http\Controllers\Admin;

use App\CouponCategories;
use App\Http\Controllers\Controller;

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
            "cats" => CouponCategories::all(),
        ]);
    }
}
