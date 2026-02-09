<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsertypesTable extends Migration
{

	public function up()
	{
		if (!Schema::hasTable('usertypes')) {
			Schema::create('usertypes', function (Blueprint $table) {
				$table->increments('id');
				$table->timestamps();
				$table->string('title');
			});
		}
	}

	public function down()
	{
		Schema::drop('usertypes');
	}
}
