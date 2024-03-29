<?php

namespace App\Http\Controllers;

use App\Models\Atendimento;
use App\Models\Documento;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Http\Request;

class LembreteController extends Controller
{
    public function index(){
        return redirect()
            ->route('lembrete.pesquisa',['select-lembrete'=>"semana"]);
    }

    public function lembretePesquisa(Request $request){

        $aux = $request->all();

        $exibir = $aux['select-lembrete'];


        /*if($exibir == "semana")
        {
            //Lembretes da semana
            $segunda = date('Y-m-d', strtotime('monday this week'));
            $domingo = date('Y-m-d', strtotime('sunday this week'));//pega domingo como o ultimo dia da semana
            $atendimentos = Atendimento::where('lembrete',true)->where('ind_status','A')->birthdayBetween(
                $segunda,
                $domingo
            )->orderby('dat_lembrete','asc')->paginate(4,['*'],'atendimentos');
            //$atendimentos->withPath(config('app.url')."/lembretes/pesquisa/");

            $documentos = documento::where('lembrete',true)->where('ind_status','A')->birthdayBetween(
                $segunda,
                $domingo
            )->orderby('dat_lembrete','asc')->paginate(4,['*'],'documentos');
            //$documentos->withPath(config('app.url')."/lembretes/pesquisa/");
            return view('lembretes',compact('exibir','documentos','atendimentos'));
        }*/
        if($exibir == "semana"){
            $atendimentos = Atendimento::where('lembrete',true)->where('ind_status','A')->birthdayBetween(
                Carbon::now()->toDateString(),
                Carbon::now()->addDays(4)->toDateString()
            )->orderby('dat_lembrete','asc')->paginate(4,['*'],'atendimentos');
            $atendimentos->withPath(config('app.url')."/lembretes/pesquisa/");

            $documentos = Documento::where('lembrete',true)->where('ind_status','A')->birthdayBetween(
                Carbon::now()->toDateString(),
                Carbon::now()->addDays(4)->toDateString()
            )->orderby('dat_lembrete','asc')->paginate(4,['*'],'documentos');
            $documentos->withPath(config('app.url')."/lembretes/pesquisa/");
            return view('lembretes',compact('exibir','documentos','atendimentos'));
        }else if($exibir == "atendimento")
        {
            $atendimentos = Atendimento::where('lembrete',true)->where('ind_status','A')->orderby('dat_lembrete','asc')->paginate(8);
            $atendimentos->withPath(config('app.url')."/lembretes/pesquisa/");
            return view('lembretes',compact('exibir','atendimentos'));
        }
        else if($exibir == "documento")
        {
            $documentos = Documento::where('lembrete',true)->where('ind_status','A')->orderby('dat_lembrete','asc')->paginate(4);
            $documentos->withPath(config('app.url')."/lembretes/pesquisa/");
            return view('lembretes',compact('exibir','documentos'));
        }

    }

    public function delete($id,$acao){
        if($acao=="semana-atendimento"){
            try{
                Atendimento::where('cod_atendimento',$id)->update(['lembrete'=>0]);
                return redirect()
                    ->route('lembrete.pesquisa',['select-lembrete'=>"semana"])->with('success', 'Lembrete finalizado com sucesso!');
            }catch(\Exception $e){
                return redirect()
                    ->route('lembrete.pesquisa',['select-lembrete'=>"semana"])->with('error', 'Falha ao finalizar o lembrete!');
            }
        }
        if($acao=="semana-documento"){
            try{
                Documento::where('cod_documento',$id)->update(['lembrete'=>0]);
                return redirect()
                    ->route('lembrete.pesquisa',['select-lembrete'=>"semana"])->with('success', 'Lembrete finalizado com sucesso!');
            }catch(\Exception $e){
                return redirect()
                    ->route('lembrete.pesquisa',['select-lembrete'=>"semana"])->with('error', 'Falha ao finalizar o lembrete!');
            }
        }
        if($acao=="atendimento"){
            try{
                Atendimento::where('cod_atendimento',$id)->update(['lembrete'=>0]);
                return redirect()
                    ->route('lembrete.pesquisa',['select-lembrete'=>"atendimento"])->with('success', 'Lembrete finalizado com sucesso!');
            }catch(\Exception $e){
                return redirect()
                    ->route('lembrete.pesquisa',['select-lembrete'=>"atendimento"])->with('error', 'Falha ao finalizar o lembrete!');
            }
        }
        if($acao=="documento"){
            try{
                Documento::where('cod_documento',$id)->update(['lembrete'=>0]);
                return redirect()
                    ->route('lembrete.pesquisa',['select-lembrete'=>"documento"])->with('success', 'Lembrete finalizado com sucesso!');
            }catch(\Exception $e){
                return redirect()
                    ->route('lembrete.pesquisa',['select-lembrete'=>"documento"])->with('error', 'Falha ao finalizar o lembrete!');
            }
        }

    }
}

