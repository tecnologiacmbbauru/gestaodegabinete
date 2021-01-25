<?php

namespace App\Http\Controllers;

use App\Http\Requests\statusAtendimentoRequest;
use Illuminate\Http\Request;
use App\Models\statusAtendimento;

class statusAtendimentoController extends Controller
{
    private $statusAtendimento;
    public function __construct(statusAtendimento $statusA){
        $this->middleware('auth');
        $this->statusA = $statusA;
    }

    public function index()
    {
        $alteracao=false;
        $statusAtendimento = $this->statusA->paginate(20);

        return view('form_status_atendimento',compact('alteracao','statusAtendimento'));

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
     * @param  \Illuminate\Http\Request\  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        
        $dataform = $request->all(); //variavel recebe todos dados do formulario

        if($dataform['ind_status'] == NULL){
            $dataform['ind_status'] = 'A';
        }
      
        $insert = $this->statusA->create($dataform);
        
        // Verifica se inseriu com sucesso
        // Redireciona para a listagem das categorias
        // Passa uma session flash success (sessão temporária)
        if ($insert)
            return redirect()
                        ->route('statusAtendimento.index')
                        ->with('success', 'Situação do Atendimento inserida com sucesso!');
    
        // Redireciona de volta com uma mensagem de erro
        return redirect()
                    ->back()
                    ->with('error', 'Falha ao inserir');

    

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // if(!$statusA = $this->statusAtendimento->find($id))
        // return redirect()->back;
        $alteracao = true;
        $statusAtendimento = $this->statusA->paginate(20);
        $statusA = $this->statusA->where('cod_status',$id)->first(); //recupera o primeiro id

        return view('form_status_atendimento',compact('alteracao','statusA','statusAtendimento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id , Request $request)
    {
        
        $statusA = statusAtendimento::findOrFail($id);
        
        $statusA->update($request->all());
       // dd($request->all());

        return redirect()
                    ->route('statusAtendimento.index')
                    ->with('success', 'Situação do Atendimento alterada com sucesso!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $statusA = statusAtendimento::findOrFail($request->id_exclusao);
        try {
            $statusA->delete();
            return redirect()
                ->route('statusAtendimento.index')
                ->with('success', 'Situação do Atendimento excluída com sucesso!');
        } catch (\Exception $e) {
            return redirect()
                ->route('statusAtendimento.index')
                ->with('error', 'Situação do Atendimento não pode ser excluída, pois existem Atendimentos vinculados!');
        }
    }
}
