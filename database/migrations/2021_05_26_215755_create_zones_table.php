<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZonesTable extends Migration {

	public function up()
	{
		Schema::create('zones', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->integer('country_id')->unsigned();
			$table->integer('state_id')->unsigned();
			$table->integer('city_id')->unsigned();
			$table->double('lat')->nullable();
			$table->double('long')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('zones');
	}
}