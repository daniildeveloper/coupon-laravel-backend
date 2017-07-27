<?php

namespace App\Http\Controllers;

use App\Model\News;

class NewsController extends Controller
{

    /**
     * show list of news
     * @return [type] [description]
     */
    public function index()
    {
        return view("pages.news.index", [
            "news" => \DB::table('news')->paginate(10),
        ]);

    }

    public function getNewsByID($id)
    {
        $news = News::find($id);

        return view('pages.news.single', [
            'news' => $news,
        ]);
    }
}
