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
            }else{
                return $next($request);
            }
        }else{
            return $next($request);
        }
    }

    public function getOrganizacao($host){
        return Organizacao::where('domain',$host)->first();
    }
}
