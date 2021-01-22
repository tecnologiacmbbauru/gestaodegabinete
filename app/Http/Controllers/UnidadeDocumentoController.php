<?php

namespace App\Http\Controllers;

use App\Models\unidadeDocumento;
use Illuminate\Http\Request;

class UnidadeDocumentoController extends Controller
{
    
    private $unidadeDocumento;


    public function __construct(unidadeDocumento $uniDoc){
        $this->middleware('auth');
        $this->uniDoc = $uniDoc;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alteracao=false;
        $unidadeDocumento = $this->uniDoc->paginate(5);

        return view('form_unidadeDocumento',compact('alteracao','unidadeDocumento'));
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

        if($dataform['ind_uni_doc'] == NULL){
            $dataform['ind_uni_doc'] == 'A';
        }
      
        $insert = $this->uniDoc->create($dataform);
        
        // Verifica se inseriu com sucesso
        // Redireciona para a listagem das categorias
        // Passa uma session flash success (sessão temporária)
        if ($insert)
            return redirect()
                        ->route('unidadeDocumento.index')
                        ->with('success', 'Unidade Administrativa inserida com sucesso!');
    
        // Redireciona de volta com uma mensagem de erro
        return redirect()
                    ->back()
                    ->with('error', 'Falha ao inserir');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\unidadeDocumento  $unidadeDocumento
     * @return \Illuminate\Http\Response
     */
    public function show(unidadeDocumento $unidadeDocumento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\unidadeDocumento  $unidadeDocumento
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $alteracao = true;
        $unidadeDocumento = $this->uniDoc->paginate(5);
        $uniDoc = $this->uniDoc->where('cod_uni_doc',$id)->first();

        return view('form_unidadeDocumento',compact('alteracao','uniDoc','unidadeDocumento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\unidadeDocumento  $unidadeDocumento
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $uniDoc = unidadeDocumento::findOrFail($id);
        $uniDoc->update($request->all());
        // dd($request->all()); debug

        return redirect()
                    ->route('unidadeDocumento.index')
                    ->with('success', 'Unidade Administrativa alterada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\unidadeDocumento  $unidadeDocumento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $uniDoc = unidadeDocumento::findOrFail($request->id_exclusao);
        try{
            $uniDoc->delete();
            return redirect()
                        ->route('unidadeDocumento.index')
                        ->with('success', 'Unidade Administrativa excluída com sucesso!');
        }catch (\Exception $e) {
            return redirect()
                ->route('unidadeDocumento.index')
                ->with('error', 'Unidade Administrativa não pode ser excluída, pois existem Documentos vinculados!');
        }
    }
}
