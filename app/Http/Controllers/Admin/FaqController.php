<?php

namespace App\Http\Controllers\Admin;

use App\Model\Faq as Quest;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    protected $table = "faqs";
    /**
     * show list of faq
     * @return [type] [description]
     */
    public function get()
    {
        return view("admin.faqs.all", [
            "faqs" => DB::table($this->table)->paginate(10),
        ]);

    }

    public function form()
    {
        return view("admin.editor", [
            "title"                        => "Новый вопрос-ответ",
            "route"                        => "faq.create",
            "content"                      => "",
            "additional_input_placeholder" => "Вопрос",
        ]);
    }

    public function create(Request $request)
    {
        $q         = new Quest();
        $q->quest  = $request["additional_input"];
        $q->answer = $request["text"];
        $q->save();
        return redirect()->route("faq.edit", [
            "id" => $q->id,
        ]);
    }

    public function update(Request $request)
    {
        \DB::table($this->table)->where("id", $request->id)->update([
            "answer" => $request["text"],
        ]);
        return redirect()->back();
    }

    /**
     * [formEdit description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function formEdit($id)
    {
        $q = Quest::find($id);
        return view("admin.editor", [
            "entity"                       => $q,
            "previewUrl"                   => "/faq/#accordion$q->id",
            "title"                        => $q->quest,
            "route"                        => "faq.update",
            "content"                      => $q->answer,
            "additional_input_placeholder" => $q->quest,
        ]);
    }
}
