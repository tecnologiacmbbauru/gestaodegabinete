<?php

namespace App\Http\Controllers;
use App\Http\Requests\agentePoliticoRequest;
use App\Models\cargoPolitico;
use Illuminate\Support\Facades\DB;
use App\Models\chaveAgenda;
use App\Models\pessoa;
use App\Models\agentePolitico;
use Carbon\Carbon;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); //verifica se esta logado, caso ao contrario redireciona para pagina de login
    }

    public function index()
    {
        $vereador = agentePolitico::first();

        if($vereador==null){
            $cargoPolitico=cargoPolitico::get();
            $alteracao = false;
            return view('form_agente_politico', compact('cargoPolitico','alteracao'));
        }
        
        
        $chaveAgenda = chaveAgenda::get()->first();

        //chama função birthdayBetween, passando como parâmetros DATA ATUAL e DATA ATUAL + 4 DIAS
        $aniversariantes = Pessoa::birthdayBetween(
            Carbon::now()->toDateString(), 
            Carbon::now()->addDays(4)->toDateString()
        )
        ->where('ind_status','A')
        //ordena os aniversariantes em ordem crescente
        ->orderByRaw('day(dat_nascimento) asc')->get();

        return view('home',compact('vereador','chaveAgenda','aniversariantes'));
    }
}
