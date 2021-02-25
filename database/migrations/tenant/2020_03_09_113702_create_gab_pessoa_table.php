<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGabPessoaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('gab_pessoa', function(Blueprint $table)
		{
			$table->increments('cod_pessoa');
			$table->enum('ind_pessoa', array('PF','PJ'));
			$table->string('nom_nome', 150);
			$table->string('nom_apelido', 100)->nullable();
			$table->string('nom_ocupacao', 150)->nullable();
			$table->date('dat_nascimento')->nullable();
			$table->string('cod_cpf_cnpj', 18)->nullable();
			$table->string('cod_ie', 15)->nullable();
			$table->string('cod_rg', 12)->nullable();
			$table->char('ind_sexo', 1)->nullable();
			$table->string('num_cep', 10)->nullable();
			$table->string('nom_endereco', 250)->nullable();
			$table->string('nom_numero', 10)->nullable();
			$table->string('nom_complemento', 200)->nullable();
			$table->string('nom_cidade', 100)->nullable();
			$table->char('nom_estado', 2)->nullable();
			$table->boolean('num_ddd_tel')->nullable();
			$table->string('num_tel', 9)->nullable();
			$table->boolean('num_ddd_cel')->nullable();
			$table->string('num_cel', 10)->nullable();
			$table->string('nom_email', 100)->nullable();
			$table->string('nom_rede_social', 200)->nullable();
			$table->binary('img_foto')->nullable();
			$table->char('ind_status', 1);
			$table->text('txt_obs', 65535)->nullable();
			$table->dateTime('dat_log')->nullable();
			$table->string('nom_usuario_log', 20)->nullable();
			$table->string('nom_operacao_log', 20)->nullable();
			$table->string('nom_re', 150)->nullable();
			$table->string('nom_bairro', 200)->nullable();
			$table->string('image') // Nome da coluna
			->nullable();    // Preenchimento não obrigatório
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
		Schema::drop('gab_pessoa');
	}

}
