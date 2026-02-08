<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSellermessagesTable extends Migration {

	public function up()
	{
		Schema::create('sellermessages', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('message');
			$table->integer('seller_id');
		});
	}

	public function down()
	{
		Schema::drop('sellermessages');
	}
}