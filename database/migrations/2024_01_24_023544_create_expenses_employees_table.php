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
        Schema::create('expenses_employees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id')->nullable()->unsigned();
            $table->string('value')->nullable();
            $table->string('total')->nullable();
            $table->string('discounts')->nullable();
            $table->string('awards')->nullable();
            $table->integer('driver_id')->nullable()->unsigned();
            $table->integer('money_left')->nullable();
            $table->string('month_date')->nullable();
            
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
        Schema::dropIfExists('expenses_employees');
    }
};
