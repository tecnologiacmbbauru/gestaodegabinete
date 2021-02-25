<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToGabAtendimentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('gab_atendimento', function(Blueprint $table)
		{
			$table->foreign('GAB_PESSOA_cod_pessoa', 'fk_cod_pessoa')->references('cod_pessoa')->on('gab_pessoa')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('GAB_TIPO_ATENDIMENTO_cod_tipo', 'fk_cod_solicitacao')->references('cod_tipo')->on('gab_tipo_atendimento')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('GAB_STATUS_ATENDIMENTO_cod_status', 'fk_cod_status_atendimento')->references('cod_status')->on('gab_status_atendimento')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('gab_atendimento', function(Blueprint $table)
		{
			$table->dropForeign('fk_cod_pessoa');
			$table->dropForeign('fk_cod_solicitacao');
			$table->dropForeign('fk_cod_status_atendimento');
		});
	}

}
