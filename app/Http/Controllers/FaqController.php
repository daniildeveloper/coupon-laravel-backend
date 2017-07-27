<?php

namespace App\Http\Controllers;

use App\Model\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(){
      return view('pages.faq', [
          'quests' => Faq::all()
        ]);
    }
}
