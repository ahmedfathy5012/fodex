<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSellersTable extends Migration
{

	public function up()
	{
		if (!Schema::hasTable('sellers')) {
			Schema::create('sellers', function (Blueprint $table) {
				$table->increments('id');
				$table->timestamps();
				$table->string('name');
				$table->string('phone')->unique();
				$table->string('mobile')->nullable();
				$table->integer('prepare_time')->default('0');
				$table->string('description')->nullable();
				$table->integer('major_id');
				$table->string('device_token')->nullable();
				$table->string('verify_code')->nullable();
				$table->string('api_token')->nullable();
				$table->string('password');
				$table->string('wallet_amount')->default('0.0');
				$table->tinyInteger('block')->default('0');
				$table->tinyInteger('availability')->default('1');
				$table->string('not_available_reason')->nullable();
				$table->string('block_reason')->nullable();
				$table->tinyInteger('close')->default('0');
			});
		}
	}

	public function down()
	{
		Schema::drop('sellers');
	}
}
