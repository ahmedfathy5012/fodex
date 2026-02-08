<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSellercontractsTable extends Migration {

	public function up()
	{
		Schema::create('sellercontracts', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->date('from_day')->nullable();
			$table->date('to_day')->nullable();
			$table->double('percantge')->default('0');
			$table->string('paper_contract_image')->nullable();
			$table->integer('employee_id')->unsigned()->nullable();
			$table->integer('seller_id')->unsigned();
			$table->string('notes')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('sellercontracts');
	}
}