<?php

namespace App\Http\Middleware\Tenant;

use App\Models\Organizacao;
use App\Tenant\ManagerTenant;
use Closure;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
        //dd(Auth::user()->domain);
        if(isset(Auth::user()->domain)){
            if(Auth::user()->domain!="system"){
                $organizacao = Organizacao::where('domain',Auth::user()->domain)->first();
                $manager = app(ManagerTenant::class);
                $manager->setConnection($organizacao);
                return $next($request);
            }else{ //caso o usuario seja "system", ou seja usuario administrador
                return $next($request);
            }
        }else{ //casso ainda não tenha nenhum usuario logado
            return $next($request);
        }
    }

    /*
    Imprementação por Host, não usada
    public function getOrganizacao($host){
        return Organizacao::where('domain',$host)->first();
    }
    */
}
