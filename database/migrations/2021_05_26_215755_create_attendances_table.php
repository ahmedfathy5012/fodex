<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAttendancesTable extends Migration {

	public function up()
	{
		Schema::create('attendances', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->time('attend_from')->nullable();
			$table->time('attend_to')->nullable();
			$table->integer('day_id')->unsigned()->nullable();
			$table->integer('employee_id')->unsigned();
			$table->string('notes')->nullable();
			$table->time('rest_from')->nullable();
			$table->time('rest_to')->nullable();
			$table->time('seconed_day_end')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('attendances');
	}
}