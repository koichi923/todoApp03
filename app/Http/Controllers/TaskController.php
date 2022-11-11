<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task; //追加
use Illuminate\Support\Facades\Validator; //追加

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // モデルもレコードを全部取得
        // $tasks = Task::all();

        // status が false のレコードのみ表示
        $tasks = Task::where('status', false)->get();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // バリデーションチェックを実装
        $rules = [
            'task_name' => 'required|max:100', //「必須」と「100文字以下」
        ];

        $messages = ['required' => '必須項目です', 'max' => '100文字以下にしてください。'];

        Validator::make($request->all(), $rules, $messages)->validate();


        // Topページから追加されたタスクが渡ってくる
        // request->allとすると送信された全てのフォーム項目の値を取得できる
        // $task_name = $request->input('task_name');
        // dd($task_name);

        /*
        Taksテーブルのnameカラムに、
        フォームから渡ってきたtask_name属性の値を割り当てます。
        やり方は簡単で、
        「モデルのインスタンス->カラム名 = 値」とするだけです。
        このようにオブジェクト形式で書くことができるのがORMの便利さ
        と言えるでしょう。
        */

        // モデルをインスタンス化
        $task = new Task;

        // 「モデル名→カラム名 = 値」 で、データを割り当てる
        $task->name =  $request->input('task_name');

        // データベースに保存
        $task->save();

        // TOP画面にリダイレクト
        return redirect('/tasks');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$idに一致するレコードを取得する
        $task = Task::find($id);
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if ($request->status === null) {

            // 編集を実装する
            $rules = [
                'task_name' => 'required|max:100',
            ];

            $messages = ['required' => '必須項目です', 'max' => '100文字以下にしてください。'];

            Validator::make($request->all(), $rules, $messages)->validate();

            // 該当のタスクを検索
            $task = Task::find($id);

            // モデル→カラム名 = 値  でデータを割り当てる
            $task->name = $request->input('task_name');

            // データベースに保存
            $task->save();

            // リダイレクト
            return redirect('/tasks');
        } else {
            // 完了を実装する
            // dd($request->status);

            // 該当のタスクを検索
            $task = Task::find($id);

            // $request->status を 0 から 1 にステータスを変更する
            $task->status = true;

            // データベースに保存
            $task->save();

            // リダイレクト
            return redirect('/tasks');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 削除を実装

        // 該当のタスクを検索
        $task = Task::find($id);

        // 正しく動作するかデバッグ
        // dd($task);

        // instanceを削除
        $task->delete();

        // リダイレクト
        return redirect('/tasks');
    }
}
