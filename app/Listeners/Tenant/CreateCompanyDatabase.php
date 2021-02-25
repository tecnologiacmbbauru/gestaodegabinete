<?php

namespace App\Listeners\Tenant;

use App\Tenant\Database\DatabaseManager;
use App\Events\Tenant\CompanyCreated;
use App\Events\Tenant\DatabaseCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateCompanyDatabase
{
    private $database;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(DatabaseManager $database)
    {
        $this->database = $database;
    }

    /**
     * Handle the event.
     *
     * @param  CompanyCreated  $event
     * @return void
     */
    public function handle(CompanyCreated $event)
    {
        $organizacao = $event->getOrganizacao();

        //envia a organização que pegou do evento para criar o database
        if (!$this->database->createDatabase($organizacao)){
            throw new \Exception('Erro ao criar a base de dados'); //erro caso não consiga criar a base de dados
        }

        //rodas as migrações
        event(new DatabaseCreated($organizacao));
    }
}
