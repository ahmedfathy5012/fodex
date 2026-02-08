<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemsTable extends Migration
{

	public function up()
	{
		if (!Schema::hasTable('items')) {
			Schema::create('items', function (Blueprint $table) {
				$table->increments('id');
				$table->timestamps();
				$table->string('title');
				$table->string('description')->nullable();
				$table->double('price');
				$table->double('discount')->default('0.0');
				$table->integer('seller_id')->unsigned();
				$table->tinyInteger('availability')->default('1');
				$table->string('not_available_reason')->nullable();
				$table->tinyInteger('appear')->default('1');
				$table->string('not_appear_reason')->nullable();
				$table->smallInteger('prepare_time')->default('0');
				$table->smallInteger('calory')->nullable();
			});
		}
	}

	public function down()
	{
		Schema::drop('items');
	}
}
