<?php

namespace App\Http\Controllers;

use App\Models\documento;
//chaves estrangeiras
use App\Models\tipoDocumento;
use App\Models\tipoAtendimento;
use App\Models\situacaoDoc;
use App\Models\unidadeDocumento;
use App\Models\atendimento;
use App\Models\pessoa;
use App\Models\statusAtendimento;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocumentoController extends Controller
{

    private $docC; 

    public function __construct(documento $docC){
        $this->middleware('auth'); //verificar se o usuario esta logado

        $this->docC = $docC;
    }

    public function index()
    {
        $alteracao=false;
        $documento = $this->docC->paginate(5);
        
        $tipoDocumento = tipoDocumento::all();
        $tipoAtendimento = tipoAtendimento::all();
        $situacaoDoc = situacaoDoc::all();
        $unidadeDocumento = unidadeDocumento::all();
        $Atendimento = atendimento::all();
        $statusAtendimento = statusAtendimento::all();
        return view('form_documento',compact('alteracao','documento','tipoDocumento','tipoAtendimento','situacaoDoc','unidadeDocumento','Atendimento','statusAtendimento'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $dataform = $request->all();
       //dd($dataform);
        if(isset($dataform['atend_rel'])==false){               //verifica se  marcou que existe atendimento relacionado
            $dataform['GAB_ATENDIMENTO_cod_atendimento']=null; //caso NÃO tenha marcado não salva o atendimento
        }
        if(isset($dataform['resp_rel'])==false){ //verifica se  marcou que existe resposta relacionada
            $dataform['dat_resposta']=null;     //caso NÃO tenha marcado não salva os campos de resposta
            $dataform['txt_resposta']=null; 
            $dataform['link_resposta']=null;
            $dataform['path_doc_resp']=null;
        }

        if($dataform['ind_status'] == NULL){
            $dataform['ind_status'] = 'A';
        }
        $dataform['nom_operacao_log'] = 'INSERT';
        $dataform['nom_usuario_log'] = auth()->user()->name;
        
        if($request->hasFile('path_doc') && $request->path_doc->isValid()){
            $docPath = $request->path_doc->store('documentos');
            $dataform['path_doc']=$docPath;
        }
        if($request->hasFile('path_doc_resp') && $request->path_doc_resp->isValid()){
            $docPath = $request->path_doc_resp->store('documentos');
            $dataform['path_doc_resp']=$docPath;
        }
        //dd($dataform);
        $insert = $this->docC->create($dataform);
                
        if ($insert)
            return redirect()
                    ->route('documento.index')
                    ->with('success', 'Documento inserido com sucesso!');
             
            return redirect()
                    ->back()
                    ->with('error', 'Falha ao inserir');
    }   

    public function show(documento $documento)
    {
        //
    }



    public function edit($id)
    {
        $alteracao = true;
        $documento = $this->docC->paginate(5);
        $docC = $this->docC->where('cod_documento',$id)->first();
        $tipoDocumento = tipoDocumento::all();
        $tipoAtendimento = tipoAtendimento::all();
        $situacaoDoc = situacaoDoc::all();
        $unidadeDocumento = unidadeDocumento::all();
        $statusAtendimento = statusAtendimento::all();

        //dd($docC->path_doc_resp);
        /*if($docC->GAB_ATENDIMENTO_cod_atendimento!=null) {
            $atendimento = DB::table('gab_atendimento')->where('cod_atendimento', $docC['GAB_ATENDIMENTO_cod_atendimento'])->first();
            $pessoa = pessoa::findOrFail($atendimento->GAB_PESSOA_cod_pessoa);
            $docIndentificao = $pessoa->cod_cpf_cnpj;
            $nomeA = $pessoa->nom_nome;
            $tipoA = tipoAtendimento::findOrFail($atendimento->GAB_TIPO_ATENDIMENTO_cod_tipo);
            $tipoA = $tipoA->nom_tipo;
            $statusA = statusAtendimento::findOrFail($atendimento->GAB_STATUS_ATENDIMENTO_cod_status);
            $statusA = $statusA->nom_status;
            $dataA = $atendimento->dat_atendimento;

            return view('form_documento',compact('alteracao','docC','documento','tipoDocumento','unidadeDocumento','tipoAtendimento','situacaoDoc','nomeA','tipoA','statusA','dataA','docIndentificao'));
        }else{*/
        return view('form_documento',compact('alteracao','docC','documento','tipoDocumento','unidadeDocumento','tipoAtendimento','situacaoDoc','statusAtendimento'));
        //}
    }

    public function update($id, Request $request)
    {
        $docC = documento::findOrFail($id);;
        if($docC['ind_status'] == NULL){
            $docC['ind_status'] = 'A';
        }
        $docC['nom_operacao_log'] = 'UPDATE';

        if($request->hasFile('path_doc') && $request->path_doc->isValid()){
            $docPath = $request->path_doc->store('documentos');
            $docC['path_doc']=$docPath;
        }
        if($request->hasFile('path_doc_resp') && $request->path_doc_resp->isValid()){
            $docPath = $request->path_doc_resp->store('documentos');
            $docC['path_doc_resp']=$docPath;
        }
        
        $docC->update($request->all());

        return redirect()
                    ->route('documento.index')
                    ->with('success', 'Documento Alterado com sucesso!');
    }

    public function destroy(request $request)
    {
        $docC = Documento::findOrFail($request->id_exclusao);
        $docC->delete();

        return redirect()
                    ->route('documento.index')
                    ->with('success', 'Documento excluído com sucesso!');
    }

    public function pesquisaDocumento(Request $request,documento $documentoModel){
        $dataform = $request->except('_token');
        $documentos = $documentoModel->pesquisaPaginada($dataform);
        $alteracao = false;
        $mostraPesq=true;
        $tipoDocumento = tipoDocumento::all();
        $tipoAtendimento = tipoAtendimento::all();
        $situacaoDoc = situacaoDoc::all();
        $unidadeDocumento = unidadeDocumento::all();
        $Atendimento = atendimento::all();
        $statusAtendimento = statusAtendimento::all();
        return view('form_documento',compact('documentos','alteracao','mostraPesq','dataform','tipoDocumento','situacaoDoc','statusAtendimento','tipoAtendimento','situacaoDoc','unidadeDocumento','Atendimento'));
    }


    public function cadAtendimento(Request $request) {
        $dataform = $request->only(['GAB_PESSOA_cod_pessoa','dat_atendimento','GAB_TIPO_ATENDIMENTO_cod_tipo','GAB_STATUS_ATENDIMENTO_cod_status']);

        $id = DB::table('gab_atendimento')->insertGetId(
            ['GAB_PESSOA_cod_pessoa' => $dataform['GAB_PESSOA_cod_pessoa'],
            'dat_atendimento'=> $dataform['dat_atendimento'],
            'GAB_TIPO_ATENDIMENTO_cod_tipo'=> $dataform['GAB_TIPO_ATENDIMENTO_cod_tipo'],
            'GAB_STATUS_ATENDIMENTO_cod_status'=> $dataform['GAB_STATUS_ATENDIMENTO_cod_status'],
            'ind_status' => 'A','nom_operacao_log'=>'INSERT'
            ],
        ); 
        
        $nome = pessoa::findOrFail($dataform['GAB_PESSOA_cod_pessoa']);
        $tipo = tipoAtendimento::findOrFail($dataform['GAB_TIPO_ATENDIMENTO_cod_tipo']);
        $status = statusAtendimento::findOrFail($dataform['GAB_STATUS_ATENDIMENTO_cod_status']);
        
        return response()->json(['codigo'=>$id,'data'=>$dataform['dat_atendimento'],'pessoa'=>$nome->nom_nome,'ident'=>$nome->cod_cpf_cnpj,'tipo'=>$tipo->nom_tipo,'situacao'=>$status->nom_status]);
    }

    public function pesqAtendimento(Request $request, atendimento $atendimento) {
        $dataform = $request->only(['GAB_PESSOA_cod_pessoa','dat_atendimento','GAB_TIPO_ATENDIMENTO_cod_tipo','GAB_STATUS_ATENDIMENTO_cod_status']);
        
        
       // Código antigo que precisava digitar todos campos para realizar uma busca
        /*$atendimentos = DB::table('gab_atendimento')->where('GAB_PESSOA_cod_pessoa',$dataform['GAB_PESSOA_cod_pessoa'])->where('dat_atendimento',$dataform['dat_atendimento'])
                                                    ->where('GAB_TIPO_ATENDIMENTO_cod_tipo',$dataform['GAB_TIPO_ATENDIMENTO_cod_tipo'])->where('GAB_STATUS_ATENDIMENTO_cod_status',$dataform['GAB_STATUS_ATENDIMENTO_cod_status'])
                                                    ->get();//*
        //Usando varios where, por padrão o laravel entende que é um and(&&).Se quisessemos usar o or(||) devemos usar o orWhere
        */

        $atendimentos = $atendimento->pesquisaLimitada($dataform); 
       //return response()->json($atendimentos);
       /*
        $saida=array('cod_atendimento','dat_atendimento','pessoa_atendimentom','status_atendimento','tipo_atendimento');
        foreach ($atendimentos as $atendimento){ 
            array_push($saida, $atendimento->cod_atendimento, date('d-m-Y', strtotime($atendimento->dat_atendimento)), $atendimento->pessoa->nom_nome, $atendimento->statusAtendimento->nom_status, $atendimento->tipoAtendimento->nom_tipo);    
        }

        
        $teste = list($cod_atendimento, $dat_atendimento, $pessoa_atendimentom, $status_atendimento, $tipo_atendimento) = $saida;
        return response()->json($teste);*/
        
        
        $pessoas = pessoa::all();
        $tipoAtendimentos = tipoAtendimento::all();
        $statusAtendimentos = statusAtendimento::all();
        $saida=array();

        //Trasnformando os dados em como quero que apareça na saida da tabela.
        //As informações que estavam como código (1,2,3) viram o nome.
        foreach($atendimentos as $atendimento) { 
            //$atendimento->dat_atendimento =  date('d/m/Y',strtotime($atendimento->dat_atendimento));
            //$atendimento->dat_atendimento = "2021/12/12";
            foreach($pessoas as $pessoa){
                if($atendimento->GAB_PESSOA_cod_pessoa === $pessoa->cod_pessoa ) {
                    $atendimento->GAB_PESSOA_cod_pessoa = $pessoa->nom_nome;  
                }
            }
            foreach($tipoAtendimentos as $tipoAtendimento) {
                if($atendimento->GAB_TIPO_ATENDIMENTO_cod_tipo === $tipoAtendimento->cod_tipo ) {
                    $atendimento->GAB_TIPO_ATENDIMENTO_cod_tipo = $tipoAtendimento->nom_tipo;  
                }
            }
            foreach($statusAtendimentos as $statusAtendimento) {
                if($atendimento->GAB_STATUS_ATENDIMENTO_cod_status === $statusAtendimento->cod_status ) {
                    $atendimento->GAB_STATUS_ATENDIMENTO_cod_status = $statusAtendimento->nom_status;  
                }
            }
            array_push($saida, $atendimento);        
        }
        return response()->json($saida);
        
    }

}
