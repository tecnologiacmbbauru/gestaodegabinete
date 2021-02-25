<?php

namespace App\Http\Controllers\Tenant;

use App\Models\Organizacao;
use App\Tenant\ManagerTenant;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    public function setaBanco(Request $request){
        
        $dominio = $request->dominio;

        $manager = app(ManagerTenant::class);

        $organizacao = $this->getOrganizacao($dominio);

        if($organizacao != null){//se a organização existir
            $manager->setConnection($organizacao); //tenta setar conexão
            $response = true;
        }else{
            $response = false;
        }

        return response()->json($response);
    }


    public function getOrganizacao($host){
        return Organizacao::where('domain',$host)->first();
    }
}
