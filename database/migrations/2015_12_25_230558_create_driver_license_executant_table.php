<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriverLicenseExecutantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_license_executant', function (Blueprint $table) {
            $table->integer('executant_id')->unsigned()->index;
            $table->foreign('executant_id')->references('id')->on('executants')->onDelete('cascade');

            $table->integer('driver_license_id')->unsigned()->index;
            $table->foreign('driver_license_id')->references('id')->on('driver_licenses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('driver_license_executant');
    }
}
