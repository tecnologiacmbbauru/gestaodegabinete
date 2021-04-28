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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        
        $tipoDocumento = tipoDocumento::all();
        $tipoAtendimento = tipoAtendimento::all();
        $situacaoDoc = situacaoDoc::all();
        $unidadeDocumento = unidadeDocumento::all();
        $Atendimento = atendimento::all();
        $statusAtendimento = statusAtendimento::all();
        return view('form_documento',compact('alteracao','tipoDocumento','tipoAtendimento','situacaoDoc','unidadeDocumento','Atendimento','statusAtendimento'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $dataform = $request->all();
        $dataform['lembrete'] = request()->has('lembrete');

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
            $docPath = $request->path_doc->store(Auth::user()->domain.'/documentos');
            $dataform['path_doc']=$docPath;
        }
        if($request->hasFile('path_doc_resp') && $request->path_doc_resp->isValid()){
            $docPath = $request->path_doc_resp->store(Auth::user()->domain.'/documentos');
            $dataform['path_doc_resp']=$docPath;
        }
        try{
            $insert = $this->docC->create($dataform); 
            return redirect()
                    ->route('documento.index')
                    ->with('success', 'Documento inserido com sucesso!');
        } catch (\Exception $e) {
            // Redireciona de volta com uma mensagem de erro
            return redirect()
                ->back()
                ->with('error', 'Falha ao inserir');
        }
    }   

    public function show(documento $documento)
    {
        //
    }



    public function edit($id)
    {
        $alteracao = true;
        $documento = $this->docC->paginate(20);
        $docC = $this->docC->where('cod_documento',$id)->first();
        $tipoDocumento = tipoDocumento::all();
        $tipoAtendimento = tipoAtendimento::all();
        $situacaoDoc = situacaoDoc::all();
        $unidadeDocumento = unidadeDocumento::all();
        $statusAtendimento = statusAtendimento::all();

        return view('form_documento',compact('alteracao','docC','documento','tipoDocumento','unidadeDocumento','tipoAtendimento','situacaoDoc','statusAtendimento'));
    }

    public function update($id, Request $request)
    {
        $docC = documento::findOrFail($id);;
        
        $dataform = $request->all();
        //dd($dataform);
        $dataform['lembrete'] = request()->has('lembrete');

        //Exclusao de lembrete
        if($dataform['excluir_lembrete']=="on"){
            $dataform['lembrete']=0;
        }
        //Exclusao de resposta
        if($dataform['excluir_resposta']=="on"){
            $dataform['dat_resposta']=null;
            $dataform['path_doc_resp']=null;
            $dataform['link_resposta']=null;
            $dataform['txt_resposta']=null;
            Storage::delete($docC->path_doc_resp); //deleta documento de resposta relacionada
        }

        if($dataform['excluir_atendimento']=="on"){
            $dataform['GAB_ATENDIMENTO_cod_atendimento'] = null;
        }

        if($docC['ind_status'] == NULL){
            $docC['ind_status'] = 'A';
        }

        $dataform['nom_operacao_log'] = 'UPDATE';
     
        if($dataform['altera_link']="on" && $dataform['lnk_documento']==null){    //verifica se selecionou para alterar o documento, mas deixou nulo o preenchimento 
            $dataform['lnk_documento'] = $docC->lnk_documento;                       //neste caso volta ao valor anterior do documento
        }
        if($dataform['altera_link_resp']="on" && $dataform['link_resposta']==null){
            $dataform['link_resposta'] = $docC->link_resposta;
        }

        if($request->hasFile('path_doc') && $request->path_doc->isValid()){ 
            $docPath = $request->path_doc->store(Auth::user()->domain.'/documento');
            $dataform['path_doc']=$docPath;
        }

        if($request->hasFile('path_doc_resp') && $request->path_doc_resp->isValid()){
            $docPath = $request->path_doc_resp->store(Auth::user()->domain.'/documento');
            $dataform['path_doc_resp']=$docPath;
        }
        if(isset($dataform['existe_atendimento'])){
            if($dataform['existe_atendimento']=='s'){
                $dataform['GAB_ATENDIMENTO_cod_atendimento'] = $docC->GAB_ATENDIMENTO_cod_atendimento;
            }
        }


        try{
            $docC->update($dataform);
            return redirect()
                ->route('documento.index')
                ->with('success', 'Documento Alterado com sucesso!');
        } catch (\Exception $e) {
            // Redireciona de volta com uma mensagem de erro
            return redirect()
                ->back()
                ->with('error', 'Falha ao alterar documento');
        }
    }

    public function destroy(request $request)
    {
        $docC = Documento::findOrFail($request->id_exclusao);

        $inativo = array('ind_status'=> 'I','nom_usuario_log' => auth()->user()->name,'nom_operacao_log'=>'DELETE' );

        $docC->update($inativo);

        Storage::delete($docC->path_doc); //deleta documento relacionado
        Storage::delete($docC->path_doc_resp); //deleta documento de resposta relacionada

        return redirect()
                    ->route('documento.index')
                    ->with('success', 'Documento excluído com sucesso!');
    }

    public function pesquisaDocumento(Request $request,documento $documentoModel){
        $dataform = $request->except('_token');
        $documentos = $documentoModel->pesquisaLimitada($dataform);
        $documentos = $documentos->paginate(20)->onEachSide(1);
        //Passar para a função de paginação a url principal (encontrada no .env) e continuar a rota "/pessoa/pesquisa"
        $documentos->withPath(config('app.url')."/documento/pesquisaDocumento");

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

    //Quando pesquisa de atendimento era feita por Json
    public function pesqAtendimento(Request $request, atendimento $atendimento) {
        $dataform = $request->only(['GAB_PESSOA_cod_pessoa','dat_atendimento','GAB_TIPO_ATENDIMENTO_cod_tipo','GAB_STATUS_ATENDIMENTO_cod_status']);

        $atendimentos = $atendimento->pesquisa10limit($dataform); 
        //return response()->json($atendimentos);
        
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
