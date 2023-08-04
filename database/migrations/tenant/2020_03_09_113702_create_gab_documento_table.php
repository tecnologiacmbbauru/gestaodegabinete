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
		Schema::create('gab_documento', function(Blueprint $table)
		{
			$table->increments('cod_documento');
			$table->string('nom_documento', 100)->nullable();
			$table->string('dat_ano', 4)->nullable();
			$table->date('dat_documento');
			$table->string('lnk_documento', 500)->nullable();
			$table->text('txt_assunto', 65535)->nullable();
			$table->integer('GAB_TIPO_DOCUMENTO_cod_tip_doc')->unsigned()->nullable()->index('fk_cod_tip_doc');
			$table->integer('GAB_STATUS_DOCUMENTO_cod_status')->unsigned()->nullable()->index('fk_cod_status_doc');
			$table->integer('GAB_UNIDADE_DOCUMENTO_cod_uni_doc')->unsigned()->nullable()->index('fk_cod_uni_doc');
			$table->integer('GAB_ATENDIMENTO_cod_atendimento')->unsigned()->nullable()->index('fk_cod_atendimento');
			$table->date('dat_resposta')->nullable();
			$table->string('link_resposta')->nullable();
			$table->text('txt_resposta', 65535)->nullable();
			$table->dateTime('dat_log')->nullable();
			$table->boolean('lembrete');
			$table->date('dat_lembrete')->nullable();
			$table->string('nom_usuario_log', 20)->nullable();
			$table->string('nom_operacao_log', 20)->nullable();
			$table->char('ind_status', 1);
			$table->timestamps();
			$table->string('path_doc') // Nome da coluna
			->nullable();   // Preenchimento não obrigatório
			$table->string('path_doc_resp') // Nome da coluna
			->nullable();   // Preenchimento não obrigatório

		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('gab_documento');
	}

};
