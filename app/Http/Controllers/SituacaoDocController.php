<?php

namespace App\Http\Controllers;

use App\Models\situacaoDoc;
use Illuminate\Http\Request;

class SituacaoDocController extends Controller
{
    private $situacaoDoc;


    public function __construct(situacaoDoc $sitDoc){
        $this->middleware('auth'); 
        $this->sitDoc = $sitDoc;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alteracao=false;
        $situacaoDoc = $this->sitDoc->paginate(20);
        $situacaoDoc->withPath(config('app.url')."/situacaoDoc");

        return view('form_situacaoDoc',compact('alteracao','situacaoDoc'));
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

        if($dataform['ind_status'] == NULL){
            $dataform['ind_status'] == 'A';
        }
      
        $insert = $this->sitDoc->create($dataform);
        
        // Verifica se inseriu com sucesso
        // Redireciona para a listagem das categorias
        // Passa uma session flash success (sessão temporária)
        if ($insert)
            return redirect()
                        ->route('situacaoDoc.index')
                        ->with('success', 'Situação do Documento inserida com sucesso!');
    
        // Redireciona de volta com uma mensagem de erro
        return redirect()
                    ->back()
                    ->with('error', 'Falha ao inserir');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\situacaoDoc  $situacaoDoc
     * @return \Illuminate\Http\Response
     */
    public function show(situacaoDoc $situacaoDoc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\situacaoDoc  $situacaoDoc
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {;
           $alteracao = true;
           $situacaoDoc = $this->sitDoc->paginate(20);
           $situacaoDoc->withPath(config('app.url')."/situacaoDoc");
           $sitDoc = $this->sitDoc->where('cod_status',$id)->first();
   
           return view('form_situacaoDoc',compact('alteracao','sitDoc','situacaoDoc'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\situacaoDoc  $situacaoDoc
     * @return \Illuminate\Http\Response
     */
    public function update($id , Request $request)
    {
        $sitDoc = situacaoDoc::findOrFail($id);
        
        $sitDoc->update($request->all());
       // dd($request->all());

        return redirect()
                    ->route('situacaoDoc.index')
                    ->with('success', 'Situação do Documento alterada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\situacaoDoc  $situacaoDoc
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $sitDoc = situacaoDoc::findOrFail($request->id_exclusao);
        try {
            $sitDoc->delete();
            return redirect()
                ->route('situacaoDoc.index')
                ->with('success', 'Situação do Documento excluída com sucesso!');
        } catch (\Exception $e){ 
            if($e->getCode()=="23000"){
                return redirect()
                    ->route('situacaoDoc.index')
                    ->with('error', 'Situação do Documento não pode ser excluída, pois existem Documentos vinculados!');
            }else{
                return redirect()
                    ->route('situacaoDoc.index')
                    ->with('error', 'Situação do Documento não pode ser excluída.');
            }    
        }
    }
}
