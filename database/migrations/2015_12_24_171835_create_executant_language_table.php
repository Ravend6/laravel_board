<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExecutantLanguageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('executant_language', function (Blueprint $table) {
            $table->integer('executant_id')->unsigned()->index;
            $table->foreign('executant_id')->references('id')->on('executants')->onDelete('cascade');

            $table->integer('language_id')->unsigned()->index;
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('executant_language');
    }
}
