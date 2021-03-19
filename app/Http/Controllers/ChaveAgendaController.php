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
        $Chaves = $this->chaveAge->paginate(20);
        $ChavePrimaria = $this->chaveAge->first();
        $alteracao=false;
        return view('form_chave_agenda',compact('Chaves','alteracao','ChavePrimaria'));

    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $dataform = $request->all(); //variavel recebe todos dados do formulario

        try{
            $insert = $this->chaveAge->create($dataform);
            // Verifica se inseriu com sucesso
            // Redireciona para a listagem das categorias
            // Passa uma session flash success (sessão temporária)
            return redirect()
                        ->route('chaveAgenda.index')
                        ->with('success', 'Chaves inseridas com sucesso! Sua Agenda já está sincronizada.');
        } catch (\Exception $e) {
            // Redireciona de volta com uma mensagem de erro
            return redirect()
                ->back()
                ->with('error', 'Falha ao inserir');
        }
    }


    public function show(chaveAgenda $chaveAgenda)
    {
        //
    }


    public function edit($id)
    {
        $alteracao = true;
        $Chaves = $this->chaveAge->paginate(20);
        $Chaves->withPath(config('app.url')."/situacaoDoc");
        $chaveAgenda = $this->chaveAge->where('id',$id)->first();

        return view('form_chave_agenda',compact('alteracao','Chaves','chaveAgenda'));
    }


    public function update(Request $request,$id)
    {
        $chaveAgenda = chaveAgenda::findOrFail($id);

        try{
            $chaveAgenda->update($request->all());
            return redirect()
                ->route('chaveAgenda.index')
                ->with('success', 'Chaves alteradas com sucesso! Sua Agenda já está sincronizada.');
        } catch (\Exception $e) {
            // Redireciona de volta com uma mensagem de erro
            return redirect()
                ->back()
                ->with('error', 'Falha ao atualizar as chaves da agenda.');
        }
    }


    public function destroy(Request $request)
    {
        $ChaveAgenda = chaveAgenda::findOrFail($request->id_exclusao); //findOr Fail retorna erro 404 se não achar nada.
        try {
            $ChaveAgenda->delete();
            return redirect()
                    ->route('chaveAgenda.index')
                    ->with('success', 'Chaves de agenda excluída com sucesso!');
        } catch (\Exception $e){
                return redirect()
                    ->route('chaveAgenda.index')
                    ->with('error', 'Chaves de agenda não pode ser excluído.');
        }

    }
}
