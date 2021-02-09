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
            /*APENAS PARA TESTES, GERAR DADOS ALEATORIOS
            PessoaSeeder::class,
            AtendimentoSeeder::class,
            DocumentoSeeder::class,
            FIM DOS DADOS DE TESTE*/
        ]);
    }
}
