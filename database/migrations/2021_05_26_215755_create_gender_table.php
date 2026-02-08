<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGenderTable extends Migration
{

	public function up()
	{
		if (!Schema::hasTable('gender')) {
			Schema::create('gender', function (Blueprint $table) {
				$table->increments('id');
				$table->timestamps();
				$table->string('title');
			});
		}
	}

	public function down()
	{
		Schema::drop('gender');
	}
}