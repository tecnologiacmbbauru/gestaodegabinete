<?php

namespace App\Http\Middleware\Tenant;

use Closure;

class CheckDomainMain
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
        if( request()->getHost() != config('tenant.domain_main') ){ //verifica se o host acessado e o dominio são de configurações do tenant
            abort(401);
        }

        return $next($request);
    }
}
