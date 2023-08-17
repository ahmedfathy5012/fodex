<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('phone')->unique();
			$table->string('password');
			$table->string('image')->nullable();
			$table->boolean('phone_verify')->default(false);
			$table->string('device_id')->nullable();
			$table->string('device_token')->nullable();
			$table->string('api_token');
			$table->string('verify_code')->nullable();
			$table->integer('usertype_id')->unsigned()->nullable();
			$table->smallInteger('role_id');
			$table->tinyInteger('block')->default('0');
			$table->string('block_reason')->nullable();
			$table->string('avatar')->nullable();
			$table->tinyInteger('active')->nullable()->default('1');
			$table->tinyInteger('appear')->default('1');
			$table->string('not_appear_reason')->nullable();
			$table->double('wallet_amount')->default('0.0');
		});
	}

	public function down()
	{
		Schema::drop('users');
	}
}