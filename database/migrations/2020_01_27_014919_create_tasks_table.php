<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('folder_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('title', 100);
            $table->date('due_date');
            $table->integer('status')->default(1);
            $table->timestamps();
            //外部キーを使用する。
            $table->foreign('folder_id')->references('id')->on('folders');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('folders', function (Blueprint $table) {
        //     $table->dropColumn('user_id');
        // });
        Schema::dropIfExists('tasks');

    }
}
