<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;//classe de hash para senha

class usersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'user_name' => 'admin',
            'password' => Hash::make('admin'),
            'corSystem' => 'blue-grey',
            'ajuda_inicio' => 1,
            'ajd_pessoa' => 1,
            'ajd_documento' => 1,
            'ajd_atendimento' => 1,
        ]);
    }
}
