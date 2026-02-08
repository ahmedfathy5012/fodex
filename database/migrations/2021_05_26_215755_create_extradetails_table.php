<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExtradetailsTable extends Migration
{

	public function up()
	{
		if (!Schema::hasTable('extradetails')) {
			Schema::create('extradetails', function (Blueprint $table) {
				$table->increments('id');
				$table->timestamps();
				$table->string('title');
				$table->double('extra_price');
				$table->integer('extra_id')->unsigned();
			});
		}
	}

	public function down()
	{
		Schema::drop('extradetails');
	}
}
