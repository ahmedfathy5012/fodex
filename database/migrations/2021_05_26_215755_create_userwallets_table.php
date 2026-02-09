<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateUserwalletsTable extends Migration
{

	public function up()
	{
		if (!Schema::hasTable('userwallets')) {
			Schema::create('userwallets', function (Blueprint $table) {
				$table->increments('id');
				$table->timestamps();
				$table->double('amount')->default('0.0');
				$table->integer('user_id')->unsigned();
				$table->integer('walletmethod_id')->unsigned();
				$table->integer('source_seller_id')->unsigned()->nullable();
				$table->integer('source_driver_id')->unsigned()->nullable();
			});
		}
	}

	public function down()
	{
		Schema::drop('userwallets');
	}
}
