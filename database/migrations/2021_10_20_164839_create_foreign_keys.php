<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('classerooms', function(Blueprint $table) {
			$table->foreign('grade_id')->references('id')->on('grades')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		// Schema::table('sections', function(Blueprint $table) {
		// 	$table->foreign('grade_id')->references('id')->on('grades')
		// 				->onDelete('cascade')
		// 				->onUpdate('cascade');
		// });
		Schema::table('sections', function(Blueprint $table) {
			$table->foreign('class_id')->references('id')->on('classerooms')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('classerooms', function(Blueprint $table) {
			$table->dropForeign('classerooms_grade_id_foreign');
		});
		// Schema::table('sections', function(Blueprint $table) {
		// 	$table->dropForeign('sections_grade_id_foreign');
		// });
		Schema::table('sections', function(Blueprint $table) {
			$table->dropForeign('sections_class_id_foreign');
		});
	}
}