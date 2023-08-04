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
		Schema::table('gab_vereador', function(Blueprint $table)
		{
			$table->foreign('GAB_CARGO_POLITICO_cod_car_pol', 'fk_cod_car_pol')->references('cod_car_pol')->on('gab_cargo_politico')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('gab_vereador', function(Blueprint $table)
		{
			$table->dropForeign('fk_cod_car_pol');
		});
	}

};
