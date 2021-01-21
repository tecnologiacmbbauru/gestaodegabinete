<?php

namespace App\Http\Controllers;

use App\Models\atendimento;
use App\Models\statusAtendimento;//Model de estrangeira
use App\Models\pessoa;//Model de chave estrangeira
use App\Models\tipoAtendimento;//Model de chave estrangeira
use Illuminate\Http\Request;

class AtendimentoController extends Controller
{
    private $Atendimento;

    public function __construct(Atendimento $atendimentoC){ 
        $this->middleware('auth'); //verificar se o usuario esta logado
        $this->atendimentoC = $atendimentoC;
    }

    public function index()
    {
        $alteracao=false;
        $Atendimento = $this->atendimentoC->paginate(5);
        $tipoAtendimento = tipoAtendimento::all();
        $statusAtendimento = statusAtendimento::all();
        $pessoas = pessoa::all();
        
        return view('form_atendimento',compact('alteracao','Atendimento','tipoAtendimento','pessoas','statusAtendimento'));

    }

    public function create()
    {

    }

    public function show()
    {

    }

    public function store(Request $request)
    {
        $dataform = $request->all();

        if($dataform['GAB_PESSOA_cod_pessoa']==null){
            return redirect()
            ->back()
            ->with('error', 'Falha ao inserir. Por favor selecione uma pessoa cadastrada.');
        } else{
        if($dataform['ind_status'] == NULL){
            $dataform['ind_status'] = 'A';
        }
        $dataform['nom_operacao_log'] = 'INSERT';
        $dataform['nom_usuario_log'] = auth()->user()->name;
       
        $insert = $this->atendimentoC->create($dataform);
        
        if ($insert)
            return redirect()
                        ->route('atendimento.index')
                        ->with('success', 'Atendimento inserido com sucesso!');
    
        // Redireciona de volta com uma mensagem de erro
        return redirect()
                    ->back()
                    ->with('error', 'Falha ao inserir');
        }
    }

    public function edit($id)
    {
        $alteracao = true;
        $Atendimento = $this->atendimentoC->paginate(5);
        $atendimentoC = $this->atendimentoC->where('cod_atendimento',$id)->first();
        $tipoAtendimento = tipoAtendimento::all();
        $statusAtendimento = statusAtendimento::all();
        $pessoas = pessoa::all();
        $dataFormatada = trim($atendimentoC['dat_atendimento']);
        $dataFormatada = date("Y-m-d",strtotime($dataFormatada));

        return view('form_atendimento',compact('alteracao','atendimentoC','Atendimento','tipoAtendimento','pessoas','statusAtendimento','dataFormatada'));
    }

    public function update(Request $request, $id)
    {
        $atendimentoC = Atendimento::findOrFail($id);
        $atendimentoC->update($request->all());
        
        return redirect()
                    ->route('atendimento.index')
                    ->with('success', 'Atendimento Alterada com sucesso!');
    }

    public function destroy(Request $request)
    {
        $atendimentoC = Atendimento::findOrFail($request->id_exclusao);
        //$atendimentoC->delete();
        $inativo = array('ind_status'=> 'I');
        $atendimentoC->update($inativo);
        return redirect()
                    ->route('atendimento.index')
                    ->with('success', 'Atendimento excluído com sucesso!');
    }

    /*Ajax request*/ 
    public function seleciona_pessoa(Request $request){
        $search = $request->search;

        if($search==''){
            $pessoas = pessoa::orderby('nom_nome','asc')->select('cod_pessoa','ind_pessoa','nom_nome','cod_rg','cod_ie','cod_cpf_cnpj','image')->where('ind_status','A')->limit(5)->get();
        }else{
            $pessoas = pessoa::orderby('nom_nome','asc')->select('cod_pessoa','ind_pessoa','nom_nome','cod_rg','cod_ie','cod_cpf_cnpj','image')->where('nom_nome', 'like', '%' .$search.'%')->where('ind_status','A')->limit(5)->get();
                                                                                                                            //  ('nom_nome', 'like', '%' .$search . '%') para pesquisar em qualquer parte do nome   
        }
        $response = array();
        foreach($pessoas as $pessoa){
            if($pessoa->ind_pessoa=="PF"){
                $response[] = array("value"=>$pessoa->cod_pessoa,"label"=>$pessoa->nom_nome." - CPF:".$pessoa->cod_cpf_cnpj." - RG:".$pessoa->cod_rg,"nome"=>$pessoa->nom_nome,"path_imagem"=>$pessoa->image);
            }else{
                $response[] = array("value"=>$pessoa->cod_pessoa,"label"=>$pessoa->nom_nome." - CNPJ:".$pessoa->cod_cpf_cnpj." - I.E:".$pessoa->cod_ie,"nome"=>$pessoa->nom_nome,"path_imagem"=>$pessoa->image);     
            }
        }
  
        return response()->json($response);
        
    }

    public function pesquisaAtendimento(Request $request,atendimento $atendimentoModel){
        $dataform = $request->except('_token');
        $Atendimento = $atendimentoModel->pesquisaPaginada($dataform);
        $alteracao = false;
        $mostraPesq=true;
        $tipoAtendimento = tipoAtendimento::all();
        $statusAtendimento = statusAtendimento::all();   
        return view('form_atendimento',compact('Atendimento','alteracao','mostraPesq','dataform','tipoAtendimento','statusAtendimento'));
    }

}
