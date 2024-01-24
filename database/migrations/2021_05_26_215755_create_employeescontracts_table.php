<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeescontractsTable extends Migration {

	public function up()
	{
		Schema::create('employeescontracts', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->date('from_day')->nullable();
			$table->date('to_day')->nullable();
			$table->integer('creator_employee_id')->unsigned()->nullable();
			$table->integer('employee_id')->unsigned();
			$table->string('paper_contract_image')->nullable();
			$table->double('sallary')->nullable();
			$table->string('notes')->nullable();
			$table->tinyInteger('active')->default(1);
		});
	}

	public function down()
	{
		Schema::drop('employeescontracts');
	}
}