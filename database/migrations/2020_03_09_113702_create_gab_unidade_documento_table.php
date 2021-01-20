<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGabUnidadeDocumentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('gab_unidade_documento', function(Blueprint $table)
		{
			$table->increments('cod_uni_doc');
			$table->string('nom_uni_doc', 150);
			$table->char('ind_uni_doc', 1);
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
		Schema::drop('gab_unidade_documento');
	}

}
