<?php

namespace Database\seeders;

use App\Models\Organizacao;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;

class OrganizacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Organizacao::create([
            'name' => 'Gabinete Teste',
            'domain' => env('DB_DATABASE'),
            'bd_database' => env('DB_DATABASE'),
            'bd_port' => env('DB_PORT'),
            'bd_hostname' => env('DB_HOST'),
            'bd_username' => env('DB_USERNAME'),
            'bd_password' => Crypt::encryptString(env('DB_PASSWORD')),
        ]);
    }
}
