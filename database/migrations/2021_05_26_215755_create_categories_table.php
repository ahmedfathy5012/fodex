<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration {

	public function up()
	{
		Schema::create('categories', function(Blueprint $table) {
			$table->increments('id');
			$table->tinyInteger('is_subcategory')->default(1);

			$table->timestamps();
			$table->string('title');
			$table->string('image')->nullable();
			$table->string('description')->nullable();
			$table->smallInteger('major_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('categories');
	}
}