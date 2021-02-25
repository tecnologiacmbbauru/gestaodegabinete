<?php

namespace App\Http\Middleware\Tenant;

use App\Models\Organizacao;
use App\Tenant\ManagerTenant;
use Closure;

class TenantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //dd($request->getHost());
        /*$manager = app(ManagerTenant::class);

        if($manager->domainIsMain())
            return $next($request);

        $organizacao = $this->getOrganizacao($request->getHost());

        /*Caso a organização não seja valida ou não tenha sido encontrada (verifica se ja não esta na rota de erro caso ao contrario ficaria um loop infinito
        if (!$organizacao && $request->url() != route('404.tenant')) {
            return redirect()->route('404.tenant');
        }else if($request->url() != route('404.tenant') && !$manager->domainIsMain()){
            $manager->setConnection($organizacao);
        }*/

        return $next($request);
    }

    public function getOrganizacao($host){
        return Organizacao::where('domain',$host)->first();
    }
}
