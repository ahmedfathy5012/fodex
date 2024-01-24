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
        Schema::create('all_collections', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('seller_id')->unsigned()->nullable();
			$table->integer('driver_id')->unsigned()->nullable();
			$table->string('total')->nullable();
			$table->string('money_taken')->nullable();
			$table->string('money_left')->nullable();
			$table->string('month_date')->nullable();
			$table->string('ordersnumber')->nullable();
            
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
        Schema::dropIfExists('all_collections');
    }
};
