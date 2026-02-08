<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCitiesTable extends Migration {

	public function up()
	{
		Schema::create('cities', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->integer('country_id')->unsigned();
			$table->integer('state_id')->unsigned();
			$table->string('lon')->nullable();
			$table->double('lat')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('cities');
	}
}