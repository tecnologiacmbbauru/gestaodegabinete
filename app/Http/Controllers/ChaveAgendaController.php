<?php

namespace App\Http\Controllers;

use App\Models\chaveAgenda;
use Illuminate\Http\Request;

class ChaveAgendaController extends Controller
{
    private $chaveAge;


    public function __construct(chaveAgenda $chaveAge){
        $this->middleware('auth'); 
        $this->chaveAge = $chaveAge;
    }


    public function index()
    {
        $chaveAgenda = chaveAgenda::get()->first();
        $alteracao=true;

        if($chaveAgenda==null){
            $alteracao=false;
            return view('form_chave_agenda',compact('alteracao'));
        }else{
            return view('form_chave_agenda',compact('alteracao','chaveAgenda'));
        }
    
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $dataform = $request->all(); //variavel recebe todos dados do formulario
        $insert = $this->chaveAge->create($dataform);
        
        // Verifica se inseriu com sucesso
        // Redireciona para a listagem das categorias
        // Passa uma session flash success (sessão temporária)
        if ($insert)
            return redirect()
                        ->route('chaveAgenda.index')
                        ->with('success', 'Chaves inseridas com sucesso! Sua Agenda já está sincronizada.');
    
        // Redireciona de volta com uma mensagem de erro
        return redirect()
                    ->back()
                    ->with('error', 'Falha ao inserir');

    }


    public function show(chaveAgenda $chaveAgenda)
    {
        //
    }


    public function edit(chaveAgenda $chaveAgenda)
    {
        //
    }


    public function update(Request $request, chaveAgenda $chaveAgenda)
    {
        //dd($request->all());
        $chaveAgenda = chaveAgenda::get()->first();
        $chaveAgenda->update($request->all());

        return redirect()
                    ->route('chaveAgenda.index')
                    ->with('success', 'Chaves alteradas com sucesso! Sua Agenda já está sincronizada.');
    }


    public function destroy(chaveAgenda $chaveAgenda)
    {
        //
    }
}
