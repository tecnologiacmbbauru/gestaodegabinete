<?php

namespace App\Http\Controllers;
use App\Models\ChaveAgenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index(){

        $chaveAgendas = ChaveAgenda::all();

        $api_key = ChaveAgenda::first();

        if($api_key!=null){
            $api_key = $api_key->api_key;
        }

        if($chaveAgendas->isEmpty()){
            return view('form_agenda_vazio');
        }else{
            return view('form_agenda',compact('chaveAgendas','api_key'));
        }
    }

}
