<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Folder;
use App\Task;
use App\http\Requests\CreateTask;
use App\http\Requests\EditTask;

class TaskController extends Controller
{
    public function index(int $id)
    {
        $folders = Folder::all();

        $current_folder = Folder::find($id);

        //リレーションを使用
        $tasks = $current_folder->tasks()->get();

        //リレーションを不使用
        //$tasks = Task::where('folder_id', $current_foler->id)->get();

        return view('tasks/index',[
            'folders' => $folders,
            'current_folder_id' => $current_folder->id,
            'tasks' => $tasks,
        ]);
    }


    public function showCreateForm(int $id)
    {
        return view('tasks/create', [
            'folder_id' => $id
        ]);
    }

    public function create(int $id, CreateTask $request)
    {
        $current_folder = Folder::find($id);

        $task = new Task();
        $task->title = $request->title;
        $task->due_date = $request->due_date;

        $current_folder->tasks()->save($task);

        return redirect()->route('tasks.index', [
            'id' => $current_folder->id,
        ]);

    }

    public function showEditForm(int $id, int $task_id)
    {
        $task  = Task::find($task_id);

        return view('tasks/edit', [
            'task' => $task,
        ]);

    }

    public function edit(int $id, int $task_id, EditTask $request)
    {
        // 1
        $task = Task::find($task_id);

        // 2
        $task->title = $request->title;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->save();

        // 3
        return redirect()->route('tasks.index', [
            'id' => $task->folder_id,
        ]);
    }

}
