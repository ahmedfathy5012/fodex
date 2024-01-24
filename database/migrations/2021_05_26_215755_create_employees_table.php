<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeesTable extends Migration {

	public function up()
	{
		Schema::create('employees', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('phone')->unique();
			$table->string('mobile')->nullable();
			$table->string('password');
			$table->string('image')->nullable();
			$table->tinyInteger('phone_verify')->default('0');
			$table->string('device_id')->nullable();
			$table->string('device_token')->nullable();
			$table->string('api_token');
			$table->string('verify_code')->nullable();
			$table->tinyInteger('block')->default('0');
			$table->string('block_reason')->nullable();
			$table->string('identification_number_image')->nullable();
			$table->string('display_block_reason')->nullable();
			$table->string('residence_deed_image')->nullable();
			$table->integer('jobtitle_id')->unsigned();
			$table->integer('gender_id')->unsigned();
			$table->string('qualification')->nullable();
			$table->date('birthday')->nullable();
			$table->string('alternative_phone')->nullable();
			$table->integer('armycase_id')->unsigned()->nullable();
			$table->date('expiry_date_postponement')->nullable();
			$table->integer('statussocial_id')->nullable();
			$table->double('wallet_amount')->default('0.0');
			$table->integer('seller_id')->unsigned()->nullable();
			$table->text('remember_token')->nullable();

		});
	}

	public function down()
	{
		Schema::drop('employees');
	}
}