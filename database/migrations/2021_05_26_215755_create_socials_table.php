<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSocialsTable extends Migration {

	public function up()
	{
		Schema::create('socials', function(Blueprint $table) {
			$table->timestamps();
			$table->increments('id');
			$table->string('facebook')->nullable();
			$table->string('instagram')->nullable();
			$table->string('twiter')->nullable();
			$table->integer('seller_id');
		});
	}

	public function down()
	{
		Schema::drop('socials');
	}
}