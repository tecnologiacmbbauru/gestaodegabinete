<?php

namespace App\Console\Commands\Tenant;

use App\Models\Organizacao;
use App\Tenant\ManagerTenant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class TenantSeeder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    ///protected $signature = 'tenants:migrations {--refresh}';
    protected $signature = 'tenants:seed {id?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run Seeder Tenants';

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

        $this->tenant->setConnection($organizacao);

        $this->info("Conectando com: {$organizacao->name}");

        $command = $this->call('db:seed',[
            '--database'  => 'tenant',
            '--class'  =>'DatabaseTenantSeeder',
            '--force'  => true
        ]);

        if($command === 0){
            $this->info("Seeder com sucesso em: {$organizacao->name}");
        }

        $this->info("Fim da conexão com: {$organizacao->name}");
        $this->info("========================================");
    }
}
