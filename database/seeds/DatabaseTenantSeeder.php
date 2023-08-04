<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseTenantSeeder extends Seeder
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
            /*
            ---------APENAS PARA TESTES, GERAR DADOS ALEATORIOS------------
            PessoaSeeder::class,
            PessoaJuridicaSeeder::class,
            AtendimentoSeeder::class,
            DocumentoSeeder::class,
            --------------------FIM DOS DADOS DE TESTE---------------------
            */
        ]);
    }
}
