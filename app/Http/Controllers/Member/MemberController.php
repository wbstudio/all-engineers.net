<?php

namespace App\Http\Controllers\Member;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\Member\Member;
use \App\Models\Member\Inquiry;
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
        //DAO
        $mdInquiry = new Inquiry();
        $Inquiry = $mdInquiry->getInquiryUnreadFlag($MemberInfo[0]["id"]);
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
        //DAO
        $mdInquiry = new Inquiry();
        $Inquiry = $mdInquiry->getInquiryUnreadFlag($MemberInfo[0]["id"]);
        $MemberInfo[0]["work_area"] = explode(",",$MemberInfo[0]["job_area"]);
        $dispData = [
            'member' => $MemberInfo[0],
        ];
        return view('member.mypagesettings',$dispData);
    }


    //member_top
    public function editmypageSettings(Request $request) {
        // var_dump($request->only(['name', 'age','email', 'current_work','id', 'work_area','memo']));

        //DAO
        $mdMember = new Member();
        $mdMember = Member::where("id",$request->input('id'))->first();
        $mdMember->name = $request->input('name');
        $mdMember->email = $request->input('email');
        $mdMember->age = $request->input('age');
        $mdMember->current_work = $request->input('current_work');
        if($request->input('work_area') != null && count($request->input('work_area')) > 0){
            $work_area = join(",",$request->input('work_area'));
            $mdMember->job_area = $work_area;
        } 
        $mdMember->memo = $request->input('memo');
        $mdMember->save();

        return redirect('member/top');

    }

    //member_top
    public function inquiryDisp() {
        $InquiryList = null;
        $email = \Cookie::get('email');
        //DAO
        $mdMember = new Member();
        $MemberInfo = $mdMember->getMemberInfo($email);
        //DAO
        $mdInquiry = new Inquiry();
        $InquiryInfo = $mdInquiry->getInquiryList($MemberInfo[0]["id"]);
        if(isset($InquiryInfo[0])){
            $InquiryList = $InquiryInfo[0];
        }
        var_dump($InquiryList);
        $dispData = [
            'member' => $MemberInfo[0],
            'inquiry' => $InquiryList,
        ];
        // return view('member.index',$dispData);
    }

}
