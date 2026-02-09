<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateSocialsTable extends Migration
{

	public function up()
	{
		if (!Schema::hasTable('socials')) {
			Schema::create('socials', function (Blueprint $table) {
				$table->timestamps();
				$table->increments('id');
				$table->string('facebook')->nullable();
				$table->string('instagram')->nullable();
			$table->string('twiter')->nullable();
			$table->integer('seller_id');
		});
	}
	}

	public function down()
	{
		Schema::drop('socials');
	}
}