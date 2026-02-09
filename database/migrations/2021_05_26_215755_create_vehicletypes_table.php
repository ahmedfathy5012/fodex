<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicletypesTable extends Migration
{
	public function up()
	{
		if (!Schema::hasTable('vehicletypes')) {
			Schema::create('vehicletypes', function (Blueprint $table) {
				$table->increments('id');
				$table->timestamps();
				$table->string('title');
			});
		}
	}

	public function down()
	{
		Schema::drop('vehicletypes');
	}
}