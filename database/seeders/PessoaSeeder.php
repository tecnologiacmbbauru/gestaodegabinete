<?php

namespace Database\seeders;

use Illuminate\Database\Seeder;
use database\factories\PessoaFactory;

class PessoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pessoa::factory()->count(500)->make();
    }
}
