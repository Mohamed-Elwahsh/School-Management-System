<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSectionsTable extends Migration {

	public function up()
	{
		Schema::create('sections', function(Blueprint $table) {
			$table->id('id');
			$table->string('name', 50);
			$table->integer('status');
			$table->bigInteger('grade_id')->unsigned();
			$table->bigInteger('class_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('sections');
	}
}