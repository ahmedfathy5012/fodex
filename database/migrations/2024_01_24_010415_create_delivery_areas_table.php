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
        Schema::create('delivery_areas', function (Blueprint $table) {
            $table->increments('id');
			$table->string('name')->nullable();
            $table->integer('country_id')->nullable()->unsigned();
            $table->integer('state_id')->nullable()->unsigned();
            $table->integer('city_id')->nullable()->unsigned();
            $table->text('text')->nullable();
			$table->integer('price')->default(0);
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
        Schema::dropIfExists('delivery_areas');
    }
};
