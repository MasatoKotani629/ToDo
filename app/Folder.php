<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    public function tasks()
    {

        //↓ $this->hasMany('App\Task', 'folder_id', 'id');を省略した形。
        return $this->hasMany('App\Task');
    }
}
