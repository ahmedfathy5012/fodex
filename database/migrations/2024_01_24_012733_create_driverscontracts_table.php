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
        Schema::create('driverscontracts', function (Blueprint $table) {
            $table->increments('id');
			$table->date('from_day')->nullable();
			$table->date('to_day')->nullable();
            $table->integer('creator_employee_id')->nullable()->unsigned();
            $table->integer('driver_id')->nullable()->unsigned();
            $table->string('paper_contract_image')->nullable();
			$table->double('sallary')->nullable();
            $table->string('notes')->nullable();
            $table->tinyInteger('active')->default(1);
            $table->integer('least_price')->nullable()->unsigned();
            $table->integer('commission')->nullable()->unsigned();

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
        Schema::dropIfExists('driverscontracts');
    }
};
