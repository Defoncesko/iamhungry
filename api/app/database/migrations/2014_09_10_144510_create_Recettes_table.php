<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRecettesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Recettes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->String('titre');
			$table->String(' tpsprepa');
			$table->String('tpscuisson');
			$table->String('nbpersonne');
			$table->integer('diff');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('Recettes');
	}

}
