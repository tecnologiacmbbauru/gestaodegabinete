<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call([
            cargoPoliticoSeeder::class,
            situacaoDocumentoSeeder::class,
            statusAtendimentoSeeder::class,
            tipoAtendimentoSeeder::class,
            tipoDocumentoSeeder::class,
            unidadeAdmSeeder::class,
            usersSeeder::class,
        ]);
    }
}
