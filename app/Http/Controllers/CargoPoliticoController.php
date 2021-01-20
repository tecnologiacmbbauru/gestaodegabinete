<?php

namespace App\Http\Controllers;

use App\Models\cargoPolitico;
use Illuminate\Http\Request;

class CargoPoliticoController extends Controller
{
    
    private $cargoPolitico;

    public function __construct(cargoPolitico $cargoPolit){
        $this->middleware('auth'); //verificar se o usuario esta logado
        $this->cargoPolit = $cargoPolit;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alteracao=false;
        $cargoPolitico = $this->cargoPolit->paginate(5);

        return view('form_cargoPolitico',compact('alteracao','cargoPolitico'));
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

        if($dataform['ind_car_pol'] == NULL){
            $dataform['ind_car_pol'] == 'A';
        }
      
        $insert = $this->cargoPolit->create($dataform);
        
        // Verifica se inseriu com sucesso
        // Redireciona para a listagem das categorias
        // Passa uma session flash success (sessão temporária)
        if ($insert)
            return redirect()
                        ->route('cargoPolitico.index')
                        ->with('success', 'Cargo Político inserido com sucesso!');
    
        // Redireciona de volta com uma mensagem de erro
        return redirect()
                    ->back()
                    ->with('error', 'Falha ao inserir');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\cargoPolitico  $cargoPolitico
     * @return \Illuminate\Http\Response
     */
    public function show(cargoPolitico $cargoPolitico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\cargoPolitico  $cargoPolitico
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $alteracao = true;
        $cargoPolitico = $this->cargoPolit->paginate(5);
        $cargoPolit = $this->cargoPolit->where('cod_car_pol',$id)->first();

        return view('form_cargoPolitico',compact('alteracao','cargoPolit','cargoPolitico'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\cargoPolitico  $cargoPolitico
     * @return \Illuminate\Http\Response
     */
    public function update( $id , Request $request)
    {
        $cargoPolit = cargoPolitico::findOrFail($id);
        
        $cargoPolit->update($request->all());
       // dd($request->all());

        return redirect()
                    ->route('cargoPolitico.index')
                    ->with('success', 'Cargo Político alterado com sucesso!');
    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\cargoPolitico  $cargoPolitico
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $cargoPolit = cargoPolitico::findOrFail($request->id_exclusao);
        $cargoPolit->delete();

        return redirect()
                    ->route('cargoPolitico.index')
                    ->with('success', 'Cargo Político excluído com sucesso!');
     }
}
