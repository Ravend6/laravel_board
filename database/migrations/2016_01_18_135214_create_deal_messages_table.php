<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDealMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deal_messages', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('task_id')->unsigned()->nullable();
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('proposition_id')->unsigned()->nullable();
            $table->foreign('proposition_id')->references('id')->on('propositions')->onDelete('cascade');

            $table->boolean('is_confirmed')->default(2); // 0-no 1-yes 2-in proccess 3-dissmis
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('deal_messages');
    }
}
