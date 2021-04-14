<?php

namespace App\Console\Commands\Tenant;

use App\Models\Organizacao;
use App\Tenant\ManagerTenant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class TenantMigrations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    ///protected $signature = 'tenants:migrations {--refresh}';
    protected $signature = 'tenants:migrations {id?} {--refresh}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run migrations Tenants';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    //Chama ManagerTenant que faz as configurações do banco
    public function __construct(ManagerTenant $tenant)
    {
        parent::__construct();
    
        $this->tenant  = $tenant; 
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        if( $this->argument('id')) { //verifica se foi passado o parametro opicional id
            $organizacao =  Organizacao::find($this->argument('id')); 

            if($organizacao)
                $this->execCommand($organizacao);
            
            return;
        }

        $organizacoes = Organizacao::all();
        foreach($organizacoes as $organizacao){
            $this->execCommand($organizacao);
        }
    }
    
    public function execCommand(Organizacao $organizacao){
        //validação para caso use o comando com --refersh
        //ULTILIZAR COMANDO REFRESH SOMENTE EM DESENVOLVIMENTO --NÃO-- EM PRODUÇÃO
        $comando = $this->option('refresh') ? 'migrate:refresh' :'migrate';
        
        $this->tenant->setConnection($organizacao);
        
        $this->info("Conectando com: {$organizacao->name}");

        if(! defined('STDIN')) define('STDIN', fopen("php://stdin","r"));
            //Sem este comando (linha 72) pode parecer o erro STDIN undefinied.

        $command = Artisan::call($comando,[
            '--force' =>true,
            '--path'  =>'/database/migrations/tenant',
        ]);

        if($command === 0){
            Artisan::call('db:seed',[
                '--class'  =>'DatabaseTenantSeeder',
                '--force'  => true
            ]);

            $this->info("Migracao com sucesso em: {$organizacao->name}");
        }

        $this->info("Fim da conexão com: {$organizacao->name}");
        $this->info("========================================");
    }
}
