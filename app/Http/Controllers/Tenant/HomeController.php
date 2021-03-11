<?php

namespace App\Http\Controllers\Tenant;

use App\Models\Organizacao;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $organizacao;

    public function __construct(Organizacao $organizacao)
    {
        $this->organizacao = $organizacao;
    }

    public function index(Request $request)
    {
        $organizacoes = Organizacao::all();
        $acao  = $request->all();
        if($acao == null){
            return view('Tenants/form_organizacoes',compact('organizacoes')); 
        }else{
            if($acao['cadastro']==null){
                return view('Tenants/cad_organizacao'); 
            }
        }
        
    }
}
