<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries_packages', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('country_id')->unsigned()->nullable();
			$table->integer('package_id')->unsigned()->nullable();
			$table->integer('price')->nullable();
			$table->integer('month_price')->unsigned()->nullable();
			$table->integer('quarteryear_price')->unsigned()->nullable();
			$table->integer('halfyear_price')->unsigned()->nullable();
			$table->integer('year_price')->unsigned()->nullable();
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
        Schema::dropIfExists('countries_packages');
    }
};
