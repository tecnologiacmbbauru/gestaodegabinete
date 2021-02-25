<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGabTipoAtendimentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('gab_tipo_atendimento', function(Blueprint $table)
		{
			$table->increments('cod_tipo');
			$table->string('nom_tipo', 150);
			$table->char('ind_tipo', 1);
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
		Schema::drop('gab_tipo_atendimento');
	}

}
