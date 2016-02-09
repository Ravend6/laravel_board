<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propositions', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('task_id')->unsigned()->nullable();
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('set null');

            $table->integer('user_executant_id')->unsigned()->nullable();
            $table->foreign('user_executant_id')->references('id')->on('users')->onDelete('set null');

            $table->decimal('price', 10, 2);
            $table->boolean('is_confirmed')->default(0); // 0-in process 1-yes 2-dissmis
            $table->text('description');
            $table->date('date_begin')->nullable();

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
        Schema::drop('propositions');
    }
}
