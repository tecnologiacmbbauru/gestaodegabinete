<?php

namespace App\Http\Controllers;

use App\Models\tipoDocumento;
use Illuminate\Http\Request;

class TipoDocumentoController extends Controller
{

    private $tipoDocumento;


    public function __construct(tipoDocumento $tipoDoc){
        $this->middleware('auth');
        $this->tipoDoc = $tipoDoc;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alteracao=false;
        $tipoDocumento = $this->tipoDoc->paginate(20); 

        return view('form_tipoDoc',compact('alteracao','tipoDocumento'));
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
        

        if($dataform['ind_tip_doc'] == NULL){
            $dataform['ind_tip_doc'] == 'A';
        }
      
        $insert = $this->tipoDoc->create($dataform);
        
        // Verifica se inseriu com sucesso
        // Redireciona para a listagem das categorias
        // Passa uma session flash success (sessão temporária)
        if ($insert)
            return redirect()
                        ->route('tipoDocumento.index')
                        ->with('success', 'Tipo de Documento inserido com sucesso!');
    
        // Redireciona de volta com uma mensagem de erro
        return redirect()
                    ->back()
                    ->with('error', 'Falha ao inserir');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\tipoDocumento  $tipoDocumento
     * @return \Illuminate\Http\Response
     */
    public function show(tipoDocumento $tipoDocumento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\tipoDocumento  $tipoDocumento
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $alteracao = true;
        $tipoDocumento = $this->tipoDoc->paginate(20); //mesmo do index
        $tipoDoc = $this->tipoDoc->where('cod_tip_doc',$id)->first();

        return view('form_tipoDoc',compact('alteracao','tipoDoc','tipoDocumento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tipoDocumento  $tipoDocumento
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $tipoDoc = TipoDocumento::findOrFail($id);
        $tipoDoc->update($request->all());
      // dd($request->all()); debug

        return redirect()
                    ->route('tipoDocumento.index')
                    ->with('success', 'Tipo de Documento alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tipoDocumento  $tipoDocumento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $tipoDoc = TipoDocumento::findOrFail($request->id_exclusao);
        try {
            $tipoDoc->delete();
            return redirect()
                        ->route('tipoDocumento.index')
                        ->with('success', 'Tipo de Documento excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()
                ->route('tipoDocumento.index')
                ->with('error', 'Tipo do Documento não pode ser excluído, pois existem Documentos vinculados!');
        }
    }
}
