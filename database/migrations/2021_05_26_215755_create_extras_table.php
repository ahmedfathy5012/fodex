<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExtrasTable extends Migration {

	public function up()
	{
		Schema::create('extras', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title');
			$table->integer('item_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('extras');
	}
}