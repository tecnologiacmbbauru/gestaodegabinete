<?php

namespace App\Http\Controllers;

use App\Models\CargoPolitico;
use Illuminate\Http\Request;

class CargoPoliticoController extends Controller
{

    private $cargoPolitico;

    public function __construct(CargoPolitico $cargoPolit){
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
        $cargoPolitico = $this->cargoPolit->paginate(20);
        //Passar para a função de paginação a url principal (encontrada no .env) e continuar a rota "/pessoa/pesquisa"
        $cargoPolitico->withPath(config('app.url')."/cargoPolitico");

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
    public function show(CargoPolitico $cargoPolitico)
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
        $cargoPolitico = $this->cargoPolit->paginate(20);
        $cargoPolitico->withPath(config('app.url')."/cargoPolitico");
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
        $cargoPolit = CargoPolitico::findOrFail($id);

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
        $cargoPolit = CargoPolitico::findOrFail($request->id_exclusao);
        try {
            $cargoPolit->delete();
            return redirect()
                        ->route('cargoPolitico.index')
                        ->with('success', 'Cargo Político excluído com sucesso!');
        } catch (\Exception $e){
            if($e->getCode()=="23000"){
                return redirect()
                    ->route('cargoPolitico.index')
                    ->with('error', 'Cargo Político não pode ser excluído, pois existe Agente Político vinculado!');
            }else{
                return redirect()
                    ->route('cargoPolitico.index')
                    ->with('error', 'Cargo Político não pode ser excluído.');
            }
        }
     }
}
