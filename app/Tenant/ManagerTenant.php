<?php

namespace App\Tenant;

use Illuminate\Support\Facades\DB;
use App\Models\Organizacao;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Crypt;

class ManagerTenant
{

    public function setConnection(Organizacao $organizacao){
        DB::purge('tenant');//remove os dados padrão/default de conexão

        //o 'tenant' que esta sendo setado é o do arquivo database.php

        //seta as configurações vinda do banco de dados
        config()->set('database.connections.tenant.host',$organizacao->bd_hostname);
        config()->set('database.connections.tenant.port',$organizacao->bd_port);
        config()->set('database.connections.tenant.database',$organizacao->bd_database);
        config()->set('database.connections.tenant.username',$organizacao->bd_username);
        config()->set('database.connections.tenant.password',Crypt::decryptString($organizacao->bd_password));
        
        DB::reconnect('tenant');//Reconceta com as novas configurações
        
        Schema::connection('tenant')->getConnection()->reconnect();
    }

    //retorna true ou false, caso seja ou não dominio principal
    public function domainIsMain(){        
        return request()->getHost() == config('tenant.domain_main');
    }

}