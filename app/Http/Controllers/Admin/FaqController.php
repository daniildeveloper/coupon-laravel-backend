<?php

namespace App\Http\Controllers\Admin;

use App\FaqQuest as Quest;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    protected $table = "faq_quests";
    /**
     * show list of faq
     * @return [type] [description]
     */
    public function get()
    {
        return view("admin.faqs.all", [
            "faqs" => DB::table("faq_quests")->where("is_show", 1)->get(),
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
        \DB::table("faq_quests")->where("id", $request->id)->update([
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

    /**
     * [toggleShowInFooter description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function toggleShowInFooter($id)
    {
        $faq = DB::table("faq_quests")->where("id", $id);

        if ($faq->get()[0]->show_in_footer === 0) {
            $faq->update(["show_in_footer" => 1]);
            return redirect()->back();
        }

        $faq->update(["show_in_footer" => 0]);
        return redirect()->back();
    }

    /**
     * set footer position
     * @param [type] $id  [description]
     * @param [type] $pos [description]
     */
    public function setFooterPos(Request $request)
    {
        DB::table($this->table)->where("id", $request->id)->update(["footer_position" => $request->pos]);
        return redirect()->back();
    }
}
