<?php

namespace App\Tenant\Database;

use App\Models\Organizacao;
use Illuminate\Support\Facades\DB;


class DatabaseManager 
{

    public function createDatabase(Organizacao $organizacao)
    {
        return DB::statement("
            CREATE DATABASE {$organizacao->bd_database} CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
        ");
    }


}