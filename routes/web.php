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

Route::get('/', function () {
    return view('welcome');
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');


// Memberページ
// ログイン
Route::get('member', [\App\Http\Controllers\MemberController::class, 'showLoginForm']);
Route::post('member', [\App\Http\Controllers\MemberController::class, 'login']);
// ログアウト
Route::get('member/logout', [\App\Http\Controllers\MemberController::class, 'logout']);

// ログイン後
Route::prefix('members')->middleware('auth:members')->group(function(){

 Route::get('dashboard', function(){ return 'memberログイン完了'; });

});



// Administerページ
// ログイン
Route::get('administer', [\App\Http\Controllers\AdministerController::class, 'showLoginForm']);
Route::post('administer', [\App\Http\Controllers\AdministerController::class, 'login']);
// ログアウト
Route::get('administer/logout', [\App\Http\Controllers\AdministerController::class, 'logout']);

// ログイン後
Route::prefix('administers')->middleware('auth:administers')->group(function(){

    Route::get('dashboard', function(){ return 'administerログイン完了'; });
    Route::get('test', [\App\Http\Controllers\TestController::class, 'form']);

    // Route::get('test', function(){ return 'memberログイン完了'; });
});
