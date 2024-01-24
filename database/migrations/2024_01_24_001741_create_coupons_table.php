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
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('id');
			$table->string('title')->nullable();
			$table->string('name')->nullable();
			$table->text('description')->nullable();
			$table->date('date_from')->nullable();
			$table->date('date_to')->nullable();
			$table->integer('minmum_price')->nullable();
			$table->integer('value')->nullable();
			$table->tinyInteger('percentage')->default(0);
			$table->integer('usage_number')->nullable();
			$table->tinyInteger('general')->default(0);
			$table->tinyInteger('delivery_fee')->default(0);
			
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
        Schema::dropIfExists('coupons');
    }
};
