<?php

namespace Database\seeders;

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
            CargoPoliticoSeeder::class,
            SituacaoDocumentoSeeder::class,
            StatusAtendimentoSeeder::class,
            TipoAtendimentoSeeder::class,
            TipoDocumentoSeeder::class,
            UnidadeAdmSeeder::class,
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
