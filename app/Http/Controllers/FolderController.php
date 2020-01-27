<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Http\Requests\CreateFolder;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    public function showCreateForm()
    {
        return view('folders/create');
    }

     // 引数にインポートしたRequestクラスを受け入れる
    public function create(CreateFolder $request)
    {
        $folder = new Folder();

        $folder->title = $request->title;

        $folder->save();

        //tasks.indexに遷移する
        return redirect()->route('tasks.index',[
            'id' => $folder->id,
        ]);

    }

}
