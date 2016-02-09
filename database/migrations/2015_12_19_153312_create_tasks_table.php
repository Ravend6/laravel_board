<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->integer('user_customer_id')->unsigned()->nullable();
            $table->foreign('user_customer_id')->references('id')->on('users')->onDelete('set null');

            $table->integer('user_executant_id')->unsigned()->nullable();
            $table->foreign('user_executant_id')->references('id')->on('users')->onDelete('set null');

            $table->integer('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');

            $table->string('title');
            $table->string('slug');
            $table->text('description');
            $table->string('image')->nullable();
            $table->decimal('price', 10, 2)->default('0.00');
            $table->boolean('is_visible')->default(0);
            // 0 - open, 1 - closed, 2 - abort
            $table->boolean('status')->default(0);
            $table->string('email');
            // $table->date('date_begin');
            // $table->date('date_end');
            $table->timestamp('date_begin')->default(0);
            $table->timestamp('date_end')->default(0);
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
        Schema::drop('tasks');
    }
}
