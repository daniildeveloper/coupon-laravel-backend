<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\TrashController as A;

class TestContoller extends Controller
{
    public function test()
    {
        $a = new A();

        $a->test();
    }
}
