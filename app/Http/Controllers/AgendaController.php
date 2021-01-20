<?php

namespace App\Http\Controllers;
use App\Models\chaveAgenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index(){
        $chaveAgenda = chaveAgenda::get()->first();
        if($chaveAgenda==null){
            return view('form_agenda_vazio');
        }else{
            return view('form_agenda',compact('chaveAgenda'));
        }
    }    

}
