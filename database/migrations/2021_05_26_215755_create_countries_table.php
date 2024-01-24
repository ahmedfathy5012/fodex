<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCountriesTable extends Migration {

	public function up()
	{
		Schema::create('countries', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('code')->nullable();
			$table->text('text')->nullable();
			$table->integer('coin_id')->unsigned()->nullable();
			$table->double('lat');
			$table->double('lon')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('countries');
	}
}