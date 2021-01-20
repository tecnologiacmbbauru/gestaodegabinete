<?php

namespace App\Providers;

use App\Models\atendimento;
use App\Models\statusAtendimento;//Model de estrangeira
use App\Models\pessoa;//Model de chave estrangeira
use App\Models\tipoAtendimento;//Model de chave estrangeira

use Illuminate\Support\ServiceProvider;

class ViewSourceAtendimentoProvider extends ServiceProvider
{
    
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    /*public function boot()
    {
        $Atendimento = atendimento::all();
        $tipoAtendimento = tipoAtendimento::all();
        $statusAtendimento = statusAtendimento::all();
        $pessoas = pessoa::all();

        view()->composer('Utils/form_pesquisa_atendimento', function ($view) use( $Atendimento,$tipoAtendimento,$statusAtendimento, $pessoas) {
            $view->with(['Atendimento'=>$Atendimento,
                        'tipoAtendimento'=>$tipoAtendimento,
                        'pessoas'=>$pessoas,
                        'statusAtendimento'=>$statusAtendimento]);
        });
    }
    */
}
