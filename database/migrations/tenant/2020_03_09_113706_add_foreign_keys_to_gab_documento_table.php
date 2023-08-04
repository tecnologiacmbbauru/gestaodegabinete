<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('gab_documento', function(Blueprint $table)
		{
			$table->foreign('GAB_ATENDIMENTO_cod_atendimento', 'fk_cod_atendimento')->references('cod_atendimento')->on('gab_atendimento')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('GAB_STATUS_DOCUMENTO_cod_status', 'fk_cod_status_doc')->references('cod_status')->on('gab_status_documento')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('GAB_TIPO_DOCUMENTO_cod_tip_doc', 'fk_cod_tip_doc')->references('cod_tip_doc')->on('gab_tipo_documento')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('GAB_UNIDADE_DOCUMENTO_cod_uni_doc', 'fk_cod_uni_doc')->references('cod_uni_doc')->on('gab_unidade_documento')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('gab_documento', function(Blueprint $table)
		{
			$table->dropForeign('fk_cod_atendimento');
			$table->dropForeign('fk_cod_status_doc');
			$table->dropForeign('fk_cod_tip_doc');
			$table->dropForeign('fk_cod_uni_doc');
		});
	}

};
