<?php

namespace App\Providers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class ExtendCollectionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Collection::macro('paginate', function ($perPage, $total = null, $page = null, $pageName = 'page') {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);

            return new LengthAwarePaginator($this->forPage($page, $perPage), $total ?: $this->count(), $perPage, $page, [
                'path' => LengthAwarePaginator::resolveCurrentPath(),
                'pageName' => $pageName,
            ]);
        });
    }
}


/*
Sobreescrevendo o método padrão de paginação
O método padrão tem seu propio limite,sobrescrevendo ele, pode se usar em uma pesquisa limitada,
assim podendo limitar o numero de registro trazidos do banco de dados
*/