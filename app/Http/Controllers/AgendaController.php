<?php

namespace App\Http\Controllers;
use App\Models\chaveAgenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index(){
        $chaveAgendas = chaveAgenda::all();

        $api_key = chaveAgenda::first()->api_key;

        if($chaveAgendas->isEmpty()){
            return view('form_agenda_vazio');
        }else{
            return view('form_agenda',compact('chaveAgendas','api_key'));
        }
    }

}
