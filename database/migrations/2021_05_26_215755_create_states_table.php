<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStatesTable extends Migration {

	public function up()
	{
		Schema::create('states', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->integer('country_id')->unsigned();
			$table->double('lat')->nullable();
			$table->double('lon')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('states');
	}
}