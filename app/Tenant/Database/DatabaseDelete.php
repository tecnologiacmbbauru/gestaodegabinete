<?php

namespace App\Tenant\Database;

use App\Models\Organizacao;
use Illuminate\Support\Facades\DB;


class DatabaseDelete 
{

    public function deleteDatabase(Organizacao $organizacao)
    {
        return DB::statement("DROP DATABASE {$organizacao->bd_database}");
    }


}