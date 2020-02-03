<?php

Route::group(['middleware' => 'auth'], function() {
    Route::get('users/index', 'UserController@index')->name('users.index');
    Route::get('users/{user}/edit', 'UserController@edit')->name('users.edit');
    Route::post('users/{user}/update', 'UserController@update')->name('users.update');
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('calender', 'CalenderController@index');

    Route::get('/folders/create', 'FolderController@showCreateForm')->name('folders.create');
    Route::post('/folders/create', 'FolderController@create');
//備考　can という名前のミドルウェアは、引数（コロン以降の部分）から適切な認可処理を判定してコントローラーメソッド実行前に適用します。
//認可処理が true を返せばそのまま後続処理に移り、false を返せば処理を中断してコード 403 でレスポンスします。
    Route::group(['middleware' => 'can:view,folder'], function() {
        Route::get('/folders/{folder}/tasks', 'TaskController@index')->name('tasks.index');

        Route::get('/folders/{folder}/tasks/create', 'TaskController@showCreateForm')->name('tasks.create');
        Route::post('/folders/{folder}/tasks/create', 'TaskController@create');

        Route::get('/folders/{folder}/tasks/{task}/edit', 'TaskController@showEditForm')->name('tasks.edit');
        Route::post('/folders/{folder}/tasks/{task}/edit', 'TaskController@edit');
    });
});

Auth::routes();
