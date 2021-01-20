<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGabAtendimentoTable extends Migration {
	
	public function up()
	{
		Schema::create('gab_atendimento', function(Blueprint $table)
		{
			$table->increments('cod_atendimento');
			$table->date('dat_atendimento');
			$table->integer('GAB_TIPO_ATENDIMENTO_cod_tipo')->unsigned()->nullable()->index('fk_cod_tipo_atendimento');
			$table->integer('GAB_PESSOA_cod_pessoa')->unsigned()->nullable()->index('fk_cod_pessoa');
			$table->integer('GAB_STATUS_ATENDIMENTO_cod_status')->unsigned()->nullable()->index('fk_cod_status_atendimento');
			$table->text('txt_detalhes', 65535)->nullable();
			$table->dateTime('dat_log')->nullable();
			$table->string('nom_usuario_log', 20)->nullable();
			$table->string('nom_operacao_log', 20)->nullable();
			$table->char('ind_status', 1);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('gab_atendimento');
	}

}
