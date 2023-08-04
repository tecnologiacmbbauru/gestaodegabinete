<?php

namespace Database\Seeders;

use App\Models\CargoPolitico;
use Illuminate\Database\Seeder;

class CargoPoliticoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CargoPolitico::create([
            'nom_car_pol' => 'Vereador',
            'ind_car_pol' => 'A',
        ]);
        CargoPolitico::create([
            'nom_car_pol' => 'Vereadora',
            'ind_car_pol' => 'A',
        ]);
    }
}
