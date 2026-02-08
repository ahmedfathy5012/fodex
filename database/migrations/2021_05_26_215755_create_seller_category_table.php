<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSellerCategoryTable extends Migration
{

	public function up()
	{
		if (!Schema::hasTable('seller_category')) {
			Schema::create('seller_category', function (Blueprint $table) {
				$table->increments('id');
				$table->timestamps();
				$table->integer('seller_id')->unsigned();
				$table->integer('category_id')->unsigned();
			});
		}
	}

	public function down()
	{
		Schema::drop('seller_category');
	}
}