<?php

namespace App\Http\Controllers\Member;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\Member\Member;
use \App\Models\Access;




class MemberController extends Controller
{
    public function showLoginForm() {

        return view('member.login');

    }

    public function login(Request $request) {

        $credentials = $request->only(['email', 'password']);
        $guard = "members";
        if(\Auth::guard($guard)->attempt($credentials)) {
            //DAO
            $mdMember = new Member();
            $MemberInfo = $mdMember->getMemberInfo($credentials["email"]);

            //cookieセット-60時間
            \Cookie::queue("email", $credentials["email"], 24*60);
            \Cookie::queue("id", $MemberInfo[0]["id"], 24*60);
            
            //accessテーブルへ
            $mdAccess = new Access;
            $mdAccess->member_id = $MemberInfo[0]["id"];
            $mdAccess->email = $MemberInfo[0]["email"];
            $mdAccess->ip_address = \Request::ip();
            $mdAccess->user_agent = $_SERVER['HTTP_USER_AGENT'];
            $mdAccess->save();

            return redirect('member/top'); // ログインしたらリダイレクト
        }
        return back()->withErrors([
            'auth' => ['アドレスまたはパスワードが正しくありません。']
        ]);
    }

    public function logout() {
        //cookie削除
        setcookie('email');
        //logout
        \Auth::logout();
        //formへ
        return redirect('member');
    }

    //member_top
    public function index() {
        $email = \Cookie::get('email');
        //DAO
        $mdMember = new Member();
        $MemberInfo = $mdMember->getMemberInfo($email);
        $dispData = [
            'member' => $MemberInfo[0],
        ];
        return view('member.index',$dispData);
    }

    //member_top
    public function mypageSettings() {
        $email = \Cookie::get('email');
        //DAO
        $mdMember = new Member();
        $MemberInfo = $mdMember->getMemberInfo($email);
        $dispData = [
            'member' => $MemberInfo[0],
        ];
        return view('member.mypagesettings',$dispData);
    }

}
