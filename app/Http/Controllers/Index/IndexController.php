<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\Member\Member;
use Illuminate\Support\Facades\Hash;
use App\Mail\registMail;
use Illuminate\Support\Facades\Mail;
/**********
 * （index/memberのみ←administerはPCのみで十分）
 * public/index.phpでUserAgentをとって
 *「BladeType」を設定
 * BladeTypeでbladeファイルをpc/spに分けてレスポンシブ化
 * ********/

class IndexController extends Controller
{
    //一覧取得
    public function index() {
        return view('index.index');
    }

    public function memberRegist(Request $request) {
        /*
        * バリデーション
        */
        $data =$this->validate($request, [
            'name' => ['required'],
            'email' => ['required', 'email','unique:members'],
            'password' => ['required', 'string', 'min:8'],
            'course' => ['required'],
            'prefecture' => ['required'],
            ]);
        /*
        * (済)バリデーション結果を出す
        * (済)登録（progress,delete_flag,statusに0を入れるのも忘れない）
        * リンクをつけてメール配信
        * リンクを踏むとstatusを変更する
        * memberページにリダイレクトさせる
        */
        //= Hash::make($request->password);
        $mdmember = new Member;
        $mdmember->name = $request->name;
        $mdmember->email = $request->email;
        if (!empty($request->password)) {
            $mdmember->password = Hash::make($request->password);
        }
        $mdmember->course = $request->course;
        $mdmember->prefecture = $request->prefecture;
        $mdmember->progress = 0;
        $mdmember->delete_flag = 0;
        $mdmember->status = 0;
        $mdmember->job_area = $request->prefecture;
        $mdmember->save();
        $data["id"] = $mdmember->id; 

        var_dump($data);

        Mail::to('admin@hoge.co.jp')->send(new registMail($data));


        var_dump("登録完了bladeファイルはまだ作ってない<br>アドレスのリンク踏んだらstatus更新→loginform");


    }

    
    //
    public function memberupdatastatus($id,$course,$prefecture) {

        $mdmember = new Member;
        $mdmember = Member::where("id",$id)->
                            where("course",$course)->
                            where("prefecture",$prefecture)->
                            first();
        $mdmember->status = 1;
        $mdmember->save();


        return redirect('member');
    }
    
}
