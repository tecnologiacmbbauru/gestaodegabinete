<?php

namespace App\Http\Controllers;

use App\Models\Atendimento;
use App\Models\CargoPolitico;
use App\Models\ChaveAgenda;
use App\Models\Pessoa;
use App\Models\Documento;
use App\Models\AgentePolitico;
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
        $vereador = AgentePolitico::first();

        if($vereador==null){
            $cargoPolitico=CargoPolitico::get();
            $alteracao = false;
            return view('form_agente_politico', compact('cargoPolitico','alteracao'));
        }

        //Chama as chaves de agenda cadastrada
        $chaveAgendas = ChaveAgenda::all();

        $api_key = ChaveAgenda::first();

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
        $lembreteDoc = Documento::where('lembrete',true)->where('ind_status','A')->where('dat_lembrete','<=',$hoje)->count();

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

        $lembreteDocProx = Documento::where('lembrete',true)->where('ind_status','A')->birthdayBetween(
            Carbon::now()->toDateString(),
            Carbon::now()->addDays(4)->toDateString()
        )->count();


        return view('home',compact('vereador','api_key','chaveAgendas','aniversariantes','lembreteAtd','lembreteDoc','lembreteAtdProx','lembreteDocProx'));
    }
}
