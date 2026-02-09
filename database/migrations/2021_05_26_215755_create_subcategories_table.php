<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubcategoriesTable extends Migration
{

	public function up()
	{
		if (!Schema::hasTable('subcategories')) {
			Schema::create('subcategories', function (Blueprint $table) {
				$table->increments('id');
				$table->timestamps();
				$table->string('title');
				$table->string('image')->nullable();
				$table->string('description')->nullable();
				$table->integer('category_id')->unsigned();
			});
		}
	}

	public function down()
	{
		Schema::drop('subcategories');
	}
}
