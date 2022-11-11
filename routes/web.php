<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

use App\Http\Controllers\TodoListController; //追記
use App\Http\Controllers\TaskController;


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

//「/list」に「GETアクセス」があったら実行
// ↓ 書き方
// Route::get(アドレス , [コントローラーの名前::class , メソッド名] );
Route::get('/list', [TodoListController::class, 'index']);

// Route::getとしていますが、
// フォームからPOST送信した場合に何か処理を行う時は、
// Route::postというように書きます。

Route::resource('tasks', TaskController::class);

