<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;


class TaskController extends Controller
{
    //Laravel は、ルーティング定義の URL の中括弧で囲まれたキーワード（{folder}）とコントローラーメソッドの仮引数名（$folder）が一致していて、かつ引数が型指定（Folder）されていれば、
    //URL の中括弧で囲まれた部分の値を ID とみなし、自動的に引数の型のモデルクラスインスタンスを作成します。
    // ルートとモデルを結びつける（バインディング）機能というわけです。
    /**
    */
    /**
     * タスク一覧
     * @param Folder $folder
     * @return \Illuminate\View\View
     */



    public function index(Folder $folder)
    {

        Log::channel('custom1')->debug('custom1');
        Log::channel('custom2')->debug('custom2');



        //ユーザーが所持していないフォルダを指定すれば403が表示される。
        // if (Auth::user()->id !== $folder->user_id) {
        //     abort(403);
        // }

        $folders = Auth::user()->folders()->get();

        //$tasks = $folder->tasks()->toSql();
        //var_dump($tasks);
        $tasks = $folder->tasks()->get();

        /**
         *
        *$current_folder = Folder::find($id);

        *備考レスポンスステータスコード
        *if (is_null($current_folder)) {
        *    abort(404);
        *}

        *リレーションを使用
        *$tasks = $current_folder->tasks()->get();
        *
        *リレーションを不使用
        *$current_folder.idと一致するtaskテーブルカラムのレコードを取得する。
        *$tasks = Task::where('folder_id', $current_foler->id)->get();
        *
        *return view('tasks/index',[
        *    'folders' => $folders,
        *    'current_folder_id' => $current_folder->id,
        *    'tasks' => $tasks,
        *]);
        *
        **/

        // return view('tasks/index', [

        // ]);

        // Log::debug("ログ出力テスト");
        // Log::debug('$folder="'.$folder.'"');
        // Log::debug('$folders="'.$folders.'"');
        // Log::debug('$tasks="'.$tasks.'"');

        return view('tasks/index')->with([
            'folders'=> $folders,
            'current_folder_id' => $folder->id,
            'tasks' => $tasks,
        ]);

    }


    public function showCreateForm(Folder $folder)
    {
        return view('tasks/create', [
            'folder_id' => $folder->id,
        ]);
    }

    public function create(Folder $folder, CreateTask $request)
    {

        $task = new Task();
        $task->title = $request->title;
        $task->due_date = $request->due_date;
        $task->user_id = Auth::user()->id;

        $folder->tasks()->save($task);

        return redirect()->route('tasks.index', [
            'folder' => $folder->id,
        ]);

    }

    public function showEditForm(Folder $folder, Task $task)
    {
        $this->checkRelation($folder, $task);

        Log::debug("ログ出力テスト2");
        Log::debug('$task="'.$task.'"');
        //備考　下記は配列でとってきている。
        // $task  = Task::find($task);
        // Log::debug("ログ出力テスト2’");
        // Log::debug('$task="'.$task.'"');
        return view('tasks/edit', [
            'task' => $task,
        ]);

    }

    public function edit(Folder $folder, Task $task, EditTask $request)
    {
        $this->checkRelation($folder, $task);

        $task->title = $request->title;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->save();

        Log::debug("ログ出力テスト3");
        Log::debug('$task="'.$task.'"');

        return redirect()->route('tasks.index', [
            'folder' => $task->folder_id,
        ]);
    }

    private function checkRelation(Folder $folder, Task $task)
    {
        if ($folder->id !== $task->folder_id) {
            abort(404);
        }
    }

}
