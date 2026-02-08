<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSellerimagesTable extends Migration {

	public function up()
	{
		Schema::create('sellerimages', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('image');
			$table->integer('seller_id');
		});
	}

	public function down()
	{
		Schema::drop('sellerimages');
	}
}