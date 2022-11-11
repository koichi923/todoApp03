<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// モデルクラス「TodoList」を使うためには、
// スクリプトの先頭でuse文によりTodoListを
// 読み込まないといけない
use App\Models\TodoList;

class TodoListController extends Controller
{
    public function index(Request $request)
    {
        // データベースからテーブル「todo_lists」
        // にある全レコードを取得
        $todo_lists = TodoList::all();

        // view(‘フォルダ名.ファイル名’)
        // ビューに値を渡すときは、
        // このように変数名と値がペアになった
        // 連想配列を第2引数に設定します。

        return view('todo_list.index', ['todo_lists' => $todo_lists]);
    }
}
