<?php

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
        factory(App\Models\Pessoa::class, 1500)->create();
    }
}
