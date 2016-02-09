<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('surname')->nullable();
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->rememberToken();
            $table->boolean('email_confirm')->default(false);
            $table->decimal('count', 10, 2)->default('0.00');
            $table->date('birthday')->nullable();
            $table->string('phone')->nullable();
            $table->string('status')->nullable();
            $table->boolean('gender')->nullable();
            $table->string('lang', 10)->default('pl');
            $table->boolean('invoice')->default(1);
            $table->string('avatar')->nullable();
            $table->string('activation_token')->nullable();
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
        Schema::drop('users');
    }
}
