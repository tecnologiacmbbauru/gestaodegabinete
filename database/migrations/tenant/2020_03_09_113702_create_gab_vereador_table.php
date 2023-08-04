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
		Schema::create('gab_vereador', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nom_vereador', 150)->nullable();
			$table->string('nom_endereco', 100)->nullable();
			$table->string('nom_numero', 10)->nullable();
			$table->string('nom_complemento', 200)->nullable();
			$table->string('nom_cidade', 100)->nullable();
			$table->char('nom_estado', 2)->nullable();
			$table->char('num_cep', 9)->nullable();
			$table->string('img_foto')->nullable();
			$table->string('tip_foto', 20)->nullable();
			$table->integer('tam_foto')->nullable();
			$table->string('nom_orgao', 150)->nullable();
			$table->integer('GAB_CARGO_POLITICO_cod_car_pol')->unsigned()->nullable()->index('fk_cod_car_pol');
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
		Schema::drop('gab_vereador');
	}

};
