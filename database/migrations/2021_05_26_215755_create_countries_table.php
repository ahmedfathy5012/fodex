<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCountriesTable extends Migration {

	public function up()
	{
		if (!Schema::hasTable('countries')) {
			Schema::create('countries', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->double('lat');
			$table->double('lon')->nullable();
			$table->timestamps();
		});
	}
	}

	public function down()
	{
		Schema::drop('countries');
	}
}