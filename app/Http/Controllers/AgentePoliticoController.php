<?php

namespace App\Http\Controllers;

use App\Http\Requests\AgentePoliticoRequest;
use App\Models\CargoPolitico;
use App\Models\AgentePolitico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

//para trabalhar com fotos
use Illuminate\Support\Facades\DB;

class AgentePoliticoController extends Controller
{
    private $agentePolitico;


    public function __construct(AgentePolitico $agentePolit)
    {
        $this->middleware('auth'); //verificar se o usuario esta logado
        $this->agentePolit = $agentePolit;
    }


    public function index()
    {
        $alteracao = false;
        $cargoPolitico = CargoPolitico::get();
        $vereadorCad = AgentePolitico::first(); //verificar se é o primeiro cadastro de vereador | saida:(Nuul ou o vereador)

        if ($vereadorCad == null) {
            return view('form_agente_politico', compact('cargoPolitico', 'alteracao', 'cargoPolitico'));
        } else {
            $alteracao = true;
            $vereador = $this->agentePolit->first();
            return view('form_agente_politico', compact('vereador', 'alteracao', 'cargoPolitico'));
        }
    }

    public function store(Request $request)
    {
        $dataform = $request->all();
        if ($request->hasFile('img_foto') && $request->img_foto->isValid()){
            $imagePath = $request->img_foto->store(Auth::user()->domain . '/agentePolitico');
            $dataform['img_foto'] = $imagePath;
        }

        try {
            $this->agentePolit->create($dataform);
            return redirect()
                ->route('agentePolitico.index')
                ->with('success', 'Agente Político cadastrado com sucesso!');
        } catch (\Exception $e) {
            // Redireciona de volta com uma mensagem de erro
            return redirect()
                ->back()
                ->with('error', 'Falha ao inserir.');
        }

    }

    public function altera(Request $request)
    {
        /*Resgata o vereador que vai fazer a alteração (primeiro vereador cadastro, só é para ter 1) */
        $vereador = AgentePolitico::first();

        $dataform = $request->all();

        /*Altera a foto do vereador com um nome aleatorio*/
        if ($request->hasFile('img_foto') && $request->img_foto->isValid()){
            Storage::delete($vereador->img_foto); //deleta foto antiga do agente
            $imagePath = $request->img_foto->store(Auth::user()->domain . '/agentePolitico');
            $dataform['img_foto'] = $imagePath;
        }

        try {
            //atualiza o vereador
            $vereador->update($dataform);
            return redirect()
                ->route('agentePolitico.index')
                ->with('success', 'Agente Político alterado com sucesso!');
        } catch (\Exception $e) {
            // Redireciona de volta com uma mensagem de erro
            return redirect()
                ->back()
                ->with('error', 'Falha ao inserir.');
        }

    }

    public function update(Request $request)
    {

        //
    }


    public function destroy(AgentePolitico $agentePolitico)
    {
        //
    }
}
