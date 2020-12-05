<?php

namespace App\Http\Controllers\Administer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Http\Controllers\Avail;
use \App\Models\Administer\Article;


class ArticleController extends Controller
{
    //一覧取得
    public function getList(Request $request) {

        $param = null;
        $baseurl = null;
        $param["page"] = 1;
        $param["per_page"] = 20;

        $course = $request->course;
        $classification = $request->classification;

        //POSTの時←検索されていれば
        if($request->method() == "POST" && $course != ""){
            $param["course"] = $request -> course;
            $baseurl[] = "course=".$param["course"];
            if($request -> $classification != null){
                $param["classification"] = $request -> classification;
                $baseurl[] = "classification=".$param["classification"];
            }
        }

        //GETの時(初期表示（検索なしの1ページ目も）)
        if($request->method() == "GET"){
            if(isset($_GET["course"]) && $_GET["course"] != ""){
                $param["course"] = $_GET["course"];
                $baseurl[] = "course=".$param["course"];
            }
            if(isset($_GET["classification"]) && $_GET["classification"] != ""){
                $param["classification"] = $_GET["classification"];
                $baseurl[] = "classification=".$param["classification"];
            }
            if(isset($_GET["page"]) && $_GET["page"] != null){
                $param["page"] = $_GET["page"];
            }
        }

        //DAO
        $mdArticle = new Article();
        $articlesData = $mdArticle->getArticlesList($param);
        $articles = $articlesData["data"];
        
        //url
        if(isset($baseurl) && $baseurl != null){
            $baseurl = join("&",$baseurl);
            $baseurl = "?".$baseurl."&page=";
        }else{
            $baseurl = "?page=";
        }
        //pagenator
        if(isset($articles) && $articles != null){
            $page = $param["page"];
            $per_page = $param["per_page"];
            $all_cnt = $articlesData["AllCnt"];
            $data = AvailController::purepagenator($all_cnt,$page,$per_page);
        }

        $dispData = [];
        if(isset($articles) && count($articles) > 0){
            $dispData = [
                'articles' => $articles,
                'pagenator' => $data ->link,
                'page' => $page,
                'baseurl' => $baseurl,
                'selected_course' => $course,
                'selected_classification' => $classification,
            ];
        }

        return view('administer.article.list', $dispData);
    }


    //regist画面表示
    public function registQuestion(Request $request) {
        //registanswerのhidden
        $dispKey =[
            "course",
            "classification",
            "title",
            "heading",
            "explanation",
            "movie_link",
            "question",
        ];
        $dispobj = new \stdClass();
        foreach($dispKey as $key){
            $value = $request -> $key;
            $dispobj -> $key = $value;
        }
        //registquestionのhidden
        $hiddenKey =[
            "commentary",
            "status"
        ];
        $hiddenArr = [];
        foreach($hiddenKey as $key){
            $hiddenArr[$key] = $request -> $key;
        }
        $dispData = [
            'hiddenArr' => $hiddenArr,
            'dispobj' => $dispobj,
        ];
        return view('administer.article.regist_question',$dispData);
    }
        
    //regist_answer画面表示
    public function registAnswer(Request $request) {
        //registanswerのhidden
        $hiddenKey =[
            "course",
            "classification",
            "title",
            "heading",
            "explanation",
            "movie_link",
            "question",
        ];
        $hiddenArr = [];
        foreach($hiddenKey as $val){
            $hiddenArr[$val] = $request -> $val;
        }
        $hiddenArr["back_flag"] = 1;
        //registquestionのhidden
        $dispKey =[
            "commentary",
            "status"
        ];
        $dispobj = new \stdClass();
        foreach($dispKey as $key){
            $value = $request -> $key;
            $dispobj -> $key = $value;
        }
        $dispData = [
            'hiddenArr' => $hiddenArr,
            'dispobj' => $dispobj,
        ];
        return view('administer.article.regist_answer',$dispData);
    }


    //regist_answer画面表示
    public function regist(Request $request) {
        /*
        * バリデーション
        */
        $this->validate($request, [
            'course' => 'required',
            'classification' => 'required',
            ]);

        /*
        * 新しいレコードの追加
        */
        #Greetingモデルクラスのオブジェクトを作成
        $article = new Article();

        #Greetingモデルクラスのプロパティに値を代入
        $article->course = $request->input('course');
        $article->classification = $request->input('classification');
        $article->title = $request->input('title');
        $article->heading = $request->input('heading');
        $article->explanation = $request->input('explanation');
        $article->movie_link = $request->input('movie_link');
        $article->question = $request->input('question');
        $article->commentary = $request->input('commentary');
        $article->delete_flag = 0;
        $article->status = $request->input('status');
            
        #Greetingモデルクラスのsaveメソッドを実行
        $article->save();
        return redirect('administer/article/list');
    }


    //regist_answer画面表示
    public function editQuestion(Request $request,$id) {

        if($request->method() == "GET"){
            //DAO
            $mdArticle = new Article();
            $articleData = $mdArticle->getArticleData($id);
            $article = $articleData[0];
        }else{
            $article = $request;
        }
         //registanswerのhidden
        $dispKey =[
            "course",
            "classification",
            "title",
            "heading",
            "explanation",
            "movie_link",
            "question",
        ];

        $dispobj = new \stdClass();
        foreach($dispKey as $key){
            $value = $article -> $key;
            $dispobj -> $key = $value;
        }
        //registquestionのhidden
        $hiddenKey =[
            "id",
            "commentary",
            "status"
        ];
        $hiddenArr = [];
        foreach($hiddenKey as $key){
            $hiddenArr[$key] = $article -> $key;
        }
        $dispData = [
            'hiddenArr' => $hiddenArr,
            'dispobj' => $dispobj,
        ];

         return view('administer.article.edit_question',$dispData);
    }

    //regist_answer画面表示
    public function editAnswer(Request $request) {
        //registanswerのhidden
        $hiddenKey =[
            "id",
            "course",
            "classification",
            "title",
            "heading",
            "explanation",
            "movie_link",
            "question",
        ];
        $hiddenArr = [];
        foreach($hiddenKey as $val){
            $hiddenArr[$val] = $request -> $val;
        }
        //registquestionのhidden
        $dispKey =[
            "commentary",
            "status"
        ];
        $dispobj = new \stdClass();
        foreach($dispKey as $key){
            $value = $request -> $key;
            $dispobj -> $key = $value;
        }
        $dispData = [
            'hiddenArr' => $hiddenArr,
            'dispobj' => $dispobj,
        ];
        return view('administer.article.edit_answer',$dispData);
    }
    

    //regist_answer画面表示
    public function edit(Request $request) {

        /*
        * 新しいレコードの追加
        */
        #Greetingモデルクラスのオブジェクトを作成
        $article = new Article();

        $article = Article::where("id",$request->input('id'))->first();
        $article->course = $request->input('course');
        $article->classification = $request->input('classification');
        $article->title = $request->input('title');
        $article->heading = $request->input('heading');
        $article->explanation = $request->input('explanation');
        $article->movie_link = $request->input('movie_link');
        $article->question = $request->input('question');
        $article->commentary = $request->input('commentary');
        $article->status = $request->input('status');        
        $article->save();

        return redirect('administer/article/list');
    }


    //regist_answer画面表示
    public function delete(Request $request) {
        $update_column = [
            'delete_flag' => 1,
        ];
         if(count($request->input('del_id')) > 0){
            Article::whereIn("id",$request->input('del_id'))
            ->update($update_column);
        }

        return redirect('administer/article/list');
    }

    
}
