<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('users', function(Blueprint $table) {
			$table->foreign('usertype_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('addresses', function(Blueprint $table) {
			$table->foreign('state_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('addresses', function(Blueprint $table) {
			$table->foreign('city_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('addresses', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('addresses', function(Blueprint $table) {
			$table->foreign('seller_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('states', function(Blueprint $table) {
			$table->foreign('country_id')->references('id')->on('countries')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('cities', function(Blueprint $table) {
			$table->foreign('country_id')->references('id')->on('countries')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('cities', function(Blueprint $table) {
			$table->foreign('state_id')->references('id')->on('states')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('subcategories', function(Blueprint $table) {
			$table->foreign('category_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('items', function(Blueprint $table) {
			$table->foreign('seller_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('images', function(Blueprint $table) {
			$table->foreign('item_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('seller_category', function(Blueprint $table) {
			$table->foreign('seller_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('seller_category', function(Blueprint $table) {
			$table->foreign('category_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('extras', function(Blueprint $table) {
			$table->foreign('item_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('sizes', function(Blueprint $table) {
			$table->foreign('item_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('workschedules', function(Blueprint $table) {
			$table->foreign('seller_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('extradetails', function(Blueprint $table) {
			$table->foreign('extra_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('employees', function(Blueprint $table) {
			$table->foreign('jobtitle_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('employees', function(Blueprint $table) {
			$table->foreign('gender_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('employees', function(Blueprint $table) {
			$table->foreign('armycase_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('employeescontracts', function(Blueprint $table) {
			$table->foreign('creator_employee_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('employeescontracts', function(Blueprint $table) {
			$table->foreign('employee_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('attendances', function(Blueprint $table) {
			$table->foreign('day_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('attendances', function(Blueprint $table) {
			$table->foreign('employee_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('sellercontracts', function(Blueprint $table) {
			$table->foreign('employee_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('sellercontracts', function(Blueprint $table) {
			$table->foreign('seller_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('zones', function(Blueprint $table) {
			$table->foreign('country_id')->references('id')->on('countries')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('zones', function(Blueprint $table) {
			$table->foreign('state_id')->references('id')->on('states')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('zones', function(Blueprint $table) {
			$table->foreign('city_id')->references('id')->on('cities')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('drivers', function(Blueprint $table) {
			$table->foreign('gender_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('drivers', function(Blueprint $table) {
			$table->foreign('armycase_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('drivers', function(Blueprint $table) {
			$table->foreign('statussocial_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('drivers', function(Blueprint $table) {
			$table->foreign('country_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('drivers', function(Blueprint $table) {
			$table->foreign('state_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('drivers', function(Blueprint $table) {
			$table->foreign('city_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('userwallets', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('userwallets', function(Blueprint $table) {
			$table->foreign('walletmethod_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('userwallets', function(Blueprint $table) {
			$table->foreign('source_seller_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('userwallets', function(Blueprint $table) {
			$table->foreign('source_driver_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
	}

	public function down()
	{
		Schema::table('users', function(Blueprint $table) {
			$table->dropForeign('users_usertype_id_foreign');
		});
		Schema::table('addresses', function(Blueprint $table) {
			$table->dropForeign('addresses_state_id_foreign');
		});
		Schema::table('addresses', function(Blueprint $table) {
			$table->dropForeign('addresses_city_id_foreign');
		});
		Schema::table('addresses', function(Blueprint $table) {
			$table->dropForeign('addresses_user_id_foreign');
		});
		Schema::table('addresses', function(Blueprint $table) {
			$table->dropForeign('addresses_seller_id_foreign');
		});
		Schema::table('states', function(Blueprint $table) {
			$table->dropForeign('states_country_id_foreign');
		});
		Schema::table('cities', function(Blueprint $table) {
			$table->dropForeign('cities_country_id_foreign');
		});
		Schema::table('cities', function(Blueprint $table) {
			$table->dropForeign('cities_state_id_foreign');
		});
		Schema::table('subcategories', function(Blueprint $table) {
			$table->dropForeign('subcategories_category_id_foreign');
		});
		Schema::table('items', function(Blueprint $table) {
			$table->dropForeign('items_seller_id_foreign');
		});
		Schema::table('images', function(Blueprint $table) {
			$table->dropForeign('images_item_id_foreign');
		});
		Schema::table('seller_category', function(Blueprint $table) {
			$table->dropForeign('seller_category_seller_id_foreign');
		});
		Schema::table('seller_category', function(Blueprint $table) {
			$table->dropForeign('seller_category_category_id_foreign');
		});
		Schema::table('extras', function(Blueprint $table) {
			$table->dropForeign('extras_item_id_foreign');
		});
		Schema::table('sizes', function(Blueprint $table) {
			$table->dropForeign('sizes_item_id_foreign');
		});
		Schema::table('workschedules', function(Blueprint $table) {
			$table->dropForeign('workschedules_seller_id_foreign');
		});
		Schema::table('extradetails', function(Blueprint $table) {
			$table->dropForeign('extradetails_extra_id_foreign');
		});
		Schema::table('employees', function(Blueprint $table) {
			$table->dropForeign('employees_jobtitle_id_foreign');
		});
		Schema::table('employees', function(Blueprint $table) {
			$table->dropForeign('employees_gender_id_foreign');
		});
		Schema::table('employees', function(Blueprint $table) {
			$table->dropForeign('employees_armycase_id_foreign');
		});
		Schema::table('employeescontracts', function(Blueprint $table) {
			$table->dropForeign('employeescontracts_creator_employee_id_foreign');
		});
		Schema::table('employeescontracts', function(Blueprint $table) {
			$table->dropForeign('employeescontracts_employee_id_foreign');
		});
		Schema::table('attendances', function(Blueprint $table) {
			$table->dropForeign('attendances_day_id_foreign');
		});
		Schema::table('attendances', function(Blueprint $table) {
			$table->dropForeign('attendances_employee_id_foreign');
		});
		Schema::table('sellercontracts', function(Blueprint $table) {
			$table->dropForeign('sellercontracts_employee_id_foreign');
		});
		Schema::table('sellercontracts', function(Blueprint $table) {
			$table->dropForeign('sellercontracts_seller_id_foreign');
		});
		Schema::table('zones', function(Blueprint $table) {
			$table->dropForeign('zones_country_id_foreign');
		});
		Schema::table('zones', function(Blueprint $table) {
			$table->dropForeign('zones_state_id_foreign');
		});
		Schema::table('zones', function(Blueprint $table) {
			$table->dropForeign('zones_city_id_foreign');
		});
		Schema::table('drivers', function(Blueprint $table) {
			$table->dropForeign('drivers_gender_id_foreign');
		});
		Schema::table('drivers', function(Blueprint $table) {
			$table->dropForeign('drivers_armycase_id_foreign');
		});
		Schema::table('drivers', function(Blueprint $table) {
			$table->dropForeign('drivers_statussocial_id_foreign');
		});
		Schema::table('drivers', function(Blueprint $table) {
			$table->dropForeign('drivers_country_id_foreign');
		});
		Schema::table('drivers', function(Blueprint $table) {
			$table->dropForeign('drivers_state_id_foreign');
		});
		Schema::table('drivers', function(Blueprint $table) {
			$table->dropForeign('drivers_city_id_foreign');
		});
		Schema::table('userwallets', function(Blueprint $table) {
			$table->dropForeign('userwallets_user_id_foreign');
		});
		Schema::table('userwallets', function(Blueprint $table) {
			$table->dropForeign('userwallets_walletmethod_id_foreign');
		});
		Schema::table('userwallets', function(Blueprint $table) {
			$table->dropForeign('userwallets_source_seller_id_foreign');
		});
		Schema::table('userwallets', function(Blueprint $table) {
			$table->dropForeign('userwallets_source_driver_id_foreign');
		});
	}
}