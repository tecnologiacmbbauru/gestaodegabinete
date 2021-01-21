<?php

use Illuminate\Database\Seeder;

class cargoPoliticoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gab_cargo_politico')->insert([
            'nom_car_pol' => 'Vereador',
            'ind_car_pol' => 'A',
        ]);
        DB::table('gab_cargo_politico')->insert([
            'nom_car_pol' => 'Vereadora',
            'ind_car_pol' => 'A',
        ]);
    }
}
