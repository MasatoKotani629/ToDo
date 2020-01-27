<?php

namespace App\Http\Controllers;

use App\Folder;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(int $id)
    {
        $folders = Folder::all();

        return view('tasks/index', [
            'folders' => $folders,
            'current_folder_id' => $id,
        ]);
    }


}
