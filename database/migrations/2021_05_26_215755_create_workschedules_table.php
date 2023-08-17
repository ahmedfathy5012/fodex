<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWorkschedulesTable extends Migration {

	public function up()
	{
		Schema::create('workschedules', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->time('work_from');
			$table->time('work_to');
			$table->smallInteger('day_id');
			$table->integer('seller_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('workschedules');
	}
}