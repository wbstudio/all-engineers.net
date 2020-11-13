<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdministerController extends Controller
{
    public function showLoginForm() {

        return view('administer.login');

    }

    public function login(Request $request) {

        $credentials = $request->only(['email', 'password']);
        $guard = "administers";
        if(\Auth::guard($guard)->attempt($credentials)) {

            return redirect($guard .'/dashboard'); // ログインしたらリダイレクト

        }

        return back()->withErrors([
            'auth' => ['アドレスまたはパスワードが正しくありません。']
        ]);
    }
}
