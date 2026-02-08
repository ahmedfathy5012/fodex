<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAddressesTable extends Migration {

	public function up()
	{
		Schema::create('addresses', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->double('lat')->nullable();
			$table->double('lon')->nullable();
			$table->smallInteger('country_id')->unsigned()->nullable();
			$table->integer('state_id')->unsigned()->nullable();
			$table->integer('city_id')->unsigned()->nullable();
			$table->string('district')->nullable();
			$table->string('street')->nullable();
			$table->string('building_number')->nullable();
			$table->integer('floor_number')->nullable();
			$table->integer('employee_id')->nullable();
			$table->integer('user_id')->unsigned();
			$table->integer('seller_id')->unsigned()->nullable();
			$table->string('title')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('addresses');
	}
}