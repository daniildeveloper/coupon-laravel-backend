<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    /**
     * show list of news
     * @return [type] [description]
     */
    public function get()
    {
        return view("admin.news.all", [
            "news" => \DB::table('news')->paginate(20),
        ]);

    }

    public function form()
    {
        return view("admin.editor", [
            "title"                        => "Новая запись",
            "route"                        => "news.create",
            "content"                      => "",
            "additional_input_placeholder" => "Новая запись в блоге",
        ]);
    }

    public function create(Request $request)
    {
        $q          = new News();
        $q->title   = $request["additional_input"];
        $q->content = $request["text"];
        $q->save();
        return redirect()->route("news.edit", [
            "id" => $q->id,
        ]);
    }

    public function update(Request $request)
    {
        \DB::table("news")->where("id", $request->id)->update([
            "answer" => $request["text"],
        ]);
        return redirect()->back();
    }

    public function formEdit($id)
    {
        $q = News::find($id);
        return view("admin.editor", [
            "entity"                       => $q,
            "previewUrl"                   => "/newspaper",
            "title"                        => $q->title,
            "route"                        => "news.update",
            "content"                      => $q->content,
            "additional_input_placeholder" => $q->title,
        ]);
    }
}
