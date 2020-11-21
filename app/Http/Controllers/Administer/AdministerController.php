<?php

namespace App\Http\Controllers\Administer;
use App\Http\Controllers\Controller;
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
            return redirect("administer/dashboard"); // ログインしたらリダイレクト

        }

        return back()->withErrors([
            'auth' => ['アドレスまたはパスワードが正しくありません。']
        ]);
    }
}
