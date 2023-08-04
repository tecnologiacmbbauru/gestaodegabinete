<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Administrador',
            'domain' => 'system',
            'user_name' => 'system',
            'password' => Hash::make('system'),
            'corSystem' => 'blue',
            'ajuda_inicio' => 1,
            'ajd_pessoa' =>1,
            'ajd_documento' =>0,
            'ajd_atendimento' =>0,
        ]);
    }
}
