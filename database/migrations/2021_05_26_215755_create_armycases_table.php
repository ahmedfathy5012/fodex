<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArmycasesTable extends Migration {

	public function up()
	{
		Schema::create('armycases', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title');
		});
	}

	public function down()
	{
		Schema::drop('armycases');
	}
}