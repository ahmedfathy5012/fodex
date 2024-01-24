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
        Schema::create('cart_extras', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cart_id')->nullable()->unsigned();
            $table->integer('extra_id')->nullable()->unsigned();
            
			$table->integer('count_number')->default(1);
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
        Schema::dropIfExists('cart_extras');
    }
};
