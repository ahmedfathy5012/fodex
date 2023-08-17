<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImagesTable extends Migration {

	public function up()
	{
		Schema::create('images', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('image');
			$table->integer('item_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('images');
	}
}