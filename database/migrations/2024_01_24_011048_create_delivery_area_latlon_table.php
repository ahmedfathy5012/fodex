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
        Schema::create('delivery_area_latlon', function (Blueprint $table) {
            $table->increments('id');
			$table->string('name')->nullable();
            $table->integer('delivery_area_id')->nullable()->unsigned();
            $table->double('lat')->nullable();
			$table->double('lon')->nullable();
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
        Schema::dropIfExists('delivery_area_latlon');
    }
};
