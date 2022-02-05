<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClasseroomsTable extends Migration {

	public function up()
	{
		Schema::create('classerooms', function(Blueprint $table) {
			$table->id('id');
			$table->string('name');
			$table->string('notes')->nullable();
			$table->bigInteger('grade_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('classerooms');
	}
}