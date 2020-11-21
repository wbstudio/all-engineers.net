<?php

namespace App\Http\Controllers\Member;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function showLoginForm() {

        return view('member.login');

    }

    public function login(Request $request) {

        $credentials = $request->only(['email', 'password']);
        $guard = "members";
        if(\Auth::guard($guard)->attempt($credentials)) {

            return redirect('member/dashboard'); // ログインしたらリダイレクト

        }

        return back()->withErrors([
            'auth' => ['アドレスまたはパスワードが正しくありません。']
        ]);
    }
}
