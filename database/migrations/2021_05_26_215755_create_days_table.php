<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDaysTable extends Migration {

	public function up()
	{
		Schema::create('days', function(Blueprint $table) {
			$table->increments('id');
			$table->string('day_ar');
			$table->string('day_en');
			$table->integer('get_day');
			$table->timestamps();
		
		});
	}

	public function down()
	{
		Schema::drop('days');
	}
}