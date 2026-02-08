<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSizesTable extends Migration
{

	public function up()
	{
		if (!Schema::hasTable('sizes')) {
			Schema::create('sizes', function (Blueprint $table) {
				$table->increments('id');
				$table->timestamps();
				$table->string('title');
				$table->double('price');
				$table->integer('item_id')->unsigned();
				$table->smallInteger('calory')->nullable();
			});
		}
	}

	public function down()
	{
		Schema::drop('sizes');
	}
}