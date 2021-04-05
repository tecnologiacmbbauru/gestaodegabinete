<?php

namespace App\Http\Controllers;

use App\Models\atendimento;
use App\Models\cargoPolitico;
use App\Models\chaveAgenda;
use App\Models\pessoa;
use App\Models\documento;
use App\Models\agentePolitico;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); //verifica se esta logado, caso ao contrario redireciona para pagina de login
    }

    public function index()
    {
        //Chama o vereador cadastrado
        $vereador = agentePolitico::first();

        if($vereador==null){
            $cargoPolitico=cargoPolitico::get();
            $alteracao = false;
            return view('form_agente_politico', compact('cargoPolitico','alteracao'));
        }

        //Chama as chaves de agenda cadastrada
        $chaveAgendas = chaveAgenda::all();

        $api_key = chaveAgenda::first();

        if($api_key!=null){
            $api_key = $api_key->api_key;
        }

        //Chama o aniversario
        //chama função birthdayBetween, passando como parâmetros DATA ATUAL e DATA ATUAL + 4 DIAS
        $aniversariantes = Pessoa::birthdayBetween(
            Carbon::now()->toDateString(),
            Carbon::now()->addDays(4)->toDateString()
        )
        ->where('ind_status','A')
        //ordena os aniversariantes em ordem crescente
        ->orderByRaw('day(dat_nascimento) asc')->get();

      
        //Chama os lembretes
        //Lembretes passou
        $hoje = new DateTime();
        $lembreteAtd = Atendimento::where('lembrete',true)->where('ind_status','A')->where('dat_lembrete','<=',$hoje)->count();
        $lembreteDoc = documento::where('lembrete',true)->where('ind_status','A')->where('dat_lembrete','<=',$hoje)->count();
            
        /*Lembretes da semana
        $segunda = date('Y-m-d', strtotime('monday this week'));
        $domingo = date('Y-m-d', strtotime('sunday this week'));//pega domingo como o ultimo dia da semana
        $lembreteAtdSemana = Atendimento::where('lembrete',true)->where('ind_status','A')->birthdayBetween(
            $segunda,
            $domingo
        )->count();

        $lembreteDocSemana = documento::where('lembrete',true)->where('ind_status','A')->BirthdayBetween(
            $segunda,
            $domingo
        )->count();*/

        $lembreteAtdProx = Atendimento::where('lembrete',true)->where('ind_status','A')->birthdayBetween(
            Carbon::now()->toDateString(),
            Carbon::now()->addDays(4)->toDateString()
        )->count();

        $lembreteDocProx = documento::where('lembrete',true)->where('ind_status','A')->birthdayBetween(
            Carbon::now()->toDateString(),
            Carbon::now()->addDays(4)->toDateString()
        )->count();

        
        return view('home',compact('vereador','api_key','chaveAgendas','aniversariantes','lembreteAtd','lembreteDoc','lembreteAtdProx','lembreteDocProx'));
    }
}
