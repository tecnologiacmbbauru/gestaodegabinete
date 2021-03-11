<?php

namespace App\Listeners\Tenant;

use App\Events\Tenant\DatabaseDeleted;
use App\Tenant\Database\DatabaseDelete;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DeleteOrganizacaoDatabase
{
    private $database;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(DatabaseDelete $database)
    {
        $this->database = $database;
    }

    /**
     * Handle the event.
     *
     * @param  DatabaseDeleted  $event
     * @return void
     */
    public function handle(DatabaseDeleted $event)
    {
        $organizacao = $event->getOrganizacao();

        //envia a organização que pegou do evento para criar o database
        if (!$this->database->deleteDatabase($organizacao)){
            throw new \Exception('Erro ao deletar a base de dados'); //erro caso não consiga criar a base de dados
        }

    }
}
