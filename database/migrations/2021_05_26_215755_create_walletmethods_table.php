<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletmethodsTable extends Migration
{

	public function up()
	{
		if (!Schema::hasTable('walletmethods')) {
			Schema::create('walletmethods', function (Blueprint $table) {
				$table->increments('id');
				$table->timestamps();
				$table->string('title');
			});
		}
	}

	public function down()
	{
		Schema::drop('walletmethods');
	}
}