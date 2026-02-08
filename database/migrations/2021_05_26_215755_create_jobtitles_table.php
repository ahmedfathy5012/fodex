<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJobtitlesTable extends Migration
{

	public function up()
	{
		if (!Schema::hasTable('jobtitles')) {
			Schema::create('jobtitles', function (Blueprint $table) {
				$table->increments('id');
				$table->timestamps();
				$table->string('title');
				$table->string('description')->nullable();
			$table->string('notes')->nullable();
		});
	}
	}

	public function down()
	{
		Schema::drop('jobtitles');
	}
}