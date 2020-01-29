<?php

namespace App\Policies;

use App\User;
use App\Folder;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Access\HandlesAuthorization;

class FolderPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     //
    // }
    public function view(User $user, Folder $folder)
    {
        Log::debug("ログ出力テスト6");
        Log::debug('$folder="'.$folder.'"');
        return $user->id === $folder->user_id;
    }
}
