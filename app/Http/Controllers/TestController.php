<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function form() {
        $value = config('course');
        return view('member.test');

    }

}


