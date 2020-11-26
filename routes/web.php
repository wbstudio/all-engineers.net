<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//集客ページ
Route::get('/', [\App\Http\Controllers\Index\IndexController::class, 'index'])->name('index');
//登録→メール→サンクス
Route::post('/', [\App\Http\Controllers\Index\IndexController::class, 'memberRegist'])->name('index');
//メール→loginform
Route::get('/updata/{id}/{course}/{prefecture}', [\App\Http\Controllers\Index\IndexController::class, 'memberupdatastatus'])->where(['id', '[1-9]+'],['course', '[1-9]+'],['prefecture', '[1-9]+'],);


// Memberページ
// ログイン
Route::get('member', [\App\Http\Controllers\Member\MemberController::class, 'showLoginForm']);
Route::post('member', [\App\Http\Controllers\Member\MemberController::class, 'login']);
// ログアウト
Route::get('member/logout', [\App\Http\Controllers\Member\MemberController::class, 'logout'])->name('member_logout');

// ログイン後
Route::prefix('member')->middleware('auth:members')->group(function(){
    //member TOp
    Route::get('top',  [\App\Http\Controllers\Member\MemberController::class, 'index'])->name('member_top');
    //My page settings-display
    Route::get('my_page_settings',  [\App\Http\Controllers\Member\MemberController::class, 'mypageSettings'])->name('my_page_settings');
    //My page settings-updata
    Route::post('my_page_settings',  [\App\Http\Controllers\Member\MemberController::class, 'editmypageSettings'])->name('my_page_settings');

});



// Administerページ
// ログイン
Route::get('administer', [\App\Http\Controllers\Administer\AdministerController::class, 'showLoginForm']);
Route::post('administer', [\App\Http\Controllers\Administer\AdministerController::class, 'login']);
// ログアウト
Route::get('administer/logout', [\App\Http\Controllers\Administer\AdministerController::class, 'logout']);

// ログイン後
Route::prefix('administer')->middleware('auth:administers')->group(function(){
    
    Route::get('dashboard',  function () {return view('administer.index');});
    
    //管理画面-記事
    Route::group(['prefix' => 'article'], function () {
        //一覧
        Route::get('/list', [\App\Http\Controllers\Administer\ArticleController::class, 'getList'])->name('article_list');
        //一覧-検索
        Route::post('/list', [\App\Http\Controllers\Administer\ArticleController::class, 'getList'])->name('article_list');
        //一覧-削除
        Route::post('/delete', [\App\Http\Controllers\Administer\ArticleController::class, 'delete'])->name('article_delete');
        //wygiwygが2つreplaceできないため問題ページ登録と解説ページを分ける
        //登録ページ表示
        Route::get('/registquestion', [\App\Http\Controllers\Administer\ArticleController::class, 'registQuestion'])->name('article_regist_question');
        //登録ページ表示
        Route::post('/registquestion', [\App\Http\Controllers\Administer\ArticleController::class, 'registQuestion'])->name('article_regist_question');
        //登録ページ表示
        Route::post('/registanswer', [\App\Http\Controllers\Administer\ArticleController::class, 'registAnswer'])->name('article_regist_answer');
        //登録
        Route::post('/regist', [\App\Http\Controllers\Administer\ArticleController::class, 'regist']);
        //編集ページ表示
        Route::get('/editquestion/{id}', [\App\Http\Controllers\Administer\ArticleController::class, 'editQuestion']);
        //編集ページ表示(戻ってきた時)
        Route::post('/editquestion/{id}', [\App\Http\Controllers\Administer\ArticleController::class, 'editQuestion']);
        //編集ページ表示
        Route::post('/editanswer', [\App\Http\Controllers\Administer\ArticleController::class, 'editAnswer'])->name('article_edit_answer');;
        //編集
        Route::post('/edit', [\App\Http\Controllers\Administer\ArticleController::class, 'edit']);
    });

    //管理画面-記事
    Route::group(['prefix' => 'inquery'], function () {
        //一覧
        Route::get('/list',function () {return view('administer.index');})->name('inquery_list');
        // //一覧-検索
        // Route::post('/list', [\App\Http\Controllers\Administer\ArticleController::class, 'getlist'])->name('article_list');
        // //一覧-削除
        // Route::post('/delete', [\App\Http\Controllers\Administer\ArticleController::class, 'delete'])->name('article_delete');
        // //登録ページ表示
        // Route::get('/regist', [\App\Http\Controllers\Administer\ArticleController::class, 'registdisp'])->name('article_regist');
        // //登録
        // Route::post('/regist', [\App\Http\Controllers\Administer\ArticleController::class, 'regist'])->name('article_regist');
        // //編集ページ表示
        // Route::get('/edit/{id}', [\App\Http\Controllers\Administer\ArticleController::class, 'editdisp'])->where('name', '[1-9]+')->name('article_edit');
        // //編集
        // Route::post('/edit', [\App\Http\Controllers\Administer\ArticleController::class, 'edit'])->name('article_edit');
    });

    //test
    Route::get('test', [\App\Http\Controllers\TestController::class, 'form']);
});
