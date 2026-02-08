<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDaysTable extends Migration {

	public function up()
	{
		if (!Schema::hasTable('days')) {
			Schema::create('days', function(Blueprint $table) {
				$table->increments('id');
				$table->timestamps();
				$table->string('day_name');
			});
		}
	}

	public function down()
	{
		Schema::drop('days');
	}
}