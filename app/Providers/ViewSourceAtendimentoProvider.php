<?php

namespace App\Providers;

use App\Models\Atendimento;
use App\Models\StatusAtendimento;//Model de estrangeira
use App\Models\Pessoa;//Model de chave estrangeira
use App\Models\TipoAtendimento;//Model de chave estrangeira

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
        $atendimento = Atendimento::all();
        $tipoAtendimento = TipoAtendimento::all();
        $statusAtendimento = StatusAtendimento::all();
        $pessoas = pessoa::all();

        view()->composer('Utils/form_pesquisa_atendimento', function ($view) use( $atendimento $tipoAtendimento, $statusAtendimento, $pessoas) {
            $view->with(['Atendimento' => $atendimento,
                        'tipoAtendimento' => $tipoAtendimento,
                        'pessoas' => $pessoas,
                        'statusAtendimento' => $statusAtendimento]);
        });
    }
    */
}
