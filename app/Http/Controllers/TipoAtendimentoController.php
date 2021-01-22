<?php

namespace App\Http\Controllers;

use App\Models\tipoAtendimento;
use Illuminate\Http\Request;

class TipoAtendimentoController extends Controller
{
    private $tipoAtendimento;

    //private  $alteracao;

    public function __construct(tipoAtendimento $tipoA){
        $this->middleware('auth');
        $this->tipoA = $tipoA;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alteracao=false;
        $tipoAtendimento = $this->tipoA->paginate(5);

        return view('form_tipoAtendimento',compact('alteracao','tipoAtendimento'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataform = $request->all();

        if($dataform['ind_tipo'] == NULL){
            $dataform['ind_tipo'] == 'A';
        }
      
        $insert = $this->tipoA->create($dataform);
        
        // Verifica se inseriu com sucesso
        // Redireciona para a listagem das categorias
        // Passa uma session flash success (sessão temporária)
        if ($insert)
            return redirect()
                        ->route('tipoAtendimento.index')
                        ->with('success', 'Tipo de Atendimento inserido com sucesso!');
    
        // Redireciona de volta com uma mensagem de erro
        return redirect()
                    ->back()
                    ->with('error', 'Falha ao inserir');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\tipoAtendimento  $tipoAtendimento
     * @return \Illuminate\Http\Response
     */
    public function show(tipoAtendimento $tipoAtendimento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\tipoAtendimento  $tipoAtendimento
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $alteracao = true;
        $tipoAtendimento = $this->tipoA->paginate(5);
        $tipoA = $this->tipoA->where('cod_tipo',$id)->first();

        return view('form_tipoAtendimento',compact('alteracao','tipoA','tipoAtendimento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tipoAtendimento  $tipoAtendimento
     * @return \Illuminate\Http\Response
     */
    public function update( $id , Request $request)
    {
        $tipoA = TipoAtendimento::findOrFail($id);
        
        $tipoA->update($request->all());
       // dd($request->all());

        return redirect()
                    ->route('tipoAtendimento.index')
                    ->with('success', 'Tipo de Atendimento alterado com sucesso!');
    } 
    

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tipoAtendimento  $tipoAtendimento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $tipoA = TipoAtendimento::findOrFail($request->id_exclusao);
        try {
            $tipoA->delete();
            return redirect()
                        ->route('tipoAtendimento.index')
                        ->with('success', 'Tipo de Atendimento excluído com sucesso!');
            } catch (\Exception $e) {
                return redirect()
                    ->route('tipoAtendimento.index')
                    ->with('error', 'Tipo do Atendimento não pode ser excluído, pois existem Atendimentos vinculados!');
            }
     }
}
