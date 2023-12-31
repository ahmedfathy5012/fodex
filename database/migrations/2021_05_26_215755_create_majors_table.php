<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMajorsTable extends Migration {

	public function up()
	{
		Schema::create('majors', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title')->nullable();
			$table->string('description')->nullable();
			$table->string('image')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('majors');
	}
}