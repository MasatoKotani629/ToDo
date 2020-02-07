<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Folder;
use App\Policies\FolderPolicy;
use App\User;
use App\Policies\UserPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */

    //Folder モデルに対する処理への認可には FolderPolicy ポリシーを使用する、という意味です。
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Folder::class => FolderPolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
