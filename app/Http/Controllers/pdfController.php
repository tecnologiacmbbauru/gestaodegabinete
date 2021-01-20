<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\agentePolitico;
use App\Models\atendimento;
use App\Models\pessoa;
use App\Models\documento;
use App\Models\tipoAtendimento;
use App\Models\statusAtendimento;
use App\Models\tipoDocumento;
use App\Models\unidadeDocumento;
use App\Models\situacaoDoc;
//use App\Http\Controllers\DB;

use App\Exports\documentosExport;
use App\Exports\pessoasExport;
use App\Exports\atendimentosExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator; //Paginação Manual

class pdfController extends Controller
{

    public function relatorioPessoa(Request $request, pessoa $pessoa) {
        switch ($request->input('action')) {
            case 'relatorio':
                $dataform = $request->input('dataform');
                $pessoas = $pessoa->pesquisa($dataform);        
                $agentePolitico = agentePolitico::first();
                $pdf = PDF::loadView('pdf/pdfRelatorioPessoa',compact('agentePolitico','pessoas'));
                $pdf->getDOMPdf()->set_option('isPhpEnabled', true); 
                return $pdf->setPaper('a4')->stream('pessoa.pdf');
            break;
            case 'relatorioExcel':
                return Excel::download(new pessoasExport, 'pessoa.xlsx');
                return Excel::download(new atendimentosExport, 'atendimento.xlsx');
            break;
        }
    }

    public function geraPdfAtendimento($id){ //gera PDF de um unico antedimento

        $atendimentos = atendimento::findOrFail($id);
        $agentePolitico = agentePolitico::first();
        $pessoa = pessoa::findOrFail($atendimentos['GAB_PESSOA_cod_pessoa']);
        

        $tipoAtendimento = tipoAtendimento::findOrFail($atendimentos['GAB_TIPO_ATENDIMENTO_cod_tipo']);

        $statusAtendimento = statusAtendimento::findOrFail($atendimentos['GAB_STATUS_ATENDIMENTO_cod_status']);

        $tipoAtendimento = $tipoAtendimento['nom_tipo'];
        $statusAtendimento =  $statusAtendimento['nom_status'];

        $pdf = PDF::loadView('pdf/pdfAtendimento',compact('agentePolitico','atendimentos','pessoa','tipoAtendimento','statusAtendimento'));
        
        return $pdf->setPaper('a4')->stream('atendimento.pdf');
    }

    public function retornaDocumento() {

        $mostrarTodos = false;
        $pessoas = pessoa::all(); 
        $tipoDocumento = tipoDocumento::all();
        $situacaoDoc = situacaoDoc::all();
        $unidadeDocumento = unidadeDocumento::all();
        ///Linha 74 e 75 rever se é bug
        $tipoAtendimento = tipoAtendimento::all();
        $statusAtendimento = statusAtendimento::all();
        return view('form_relat_documento',compact('pessoas','tipoDocumento','situacaoDoc','unidadeDocumento','tipoAtendimento','statusAtendimento','mostrarTodos'));
    }

    public function retornaAtendimento() {
        $pessoas = pessoa::all();
        $pessoasCidade = pessoa::distinct()->whereNotNull('nom_cidade')->get(['nom_cidade']);
        $cidades = array();
        $pessoasBairro = pessoa::distinct()->whereNotNull('nom_bairro')->get(['nom_bairro']);
        $bairros = array();
        $pessoasEstados = pessoa::distinct()->whereNotNull('nom_estado')->get(['nom_estado']);
        $estados = array();
        foreach($pessoasCidade as $pessoa){
            array_push($cidades, $pessoa->nom_cidade);
        }
        foreach($pessoasBairro as $pessoa){
            array_push($bairros, $pessoa->nom_bairro);
        }
        foreach($pessoasEstados as $pessoa){
            array_push($estados, $pessoa->nom_estado);
        }
        $mostrarTodos = false;
        $pessoas = pessoa::all(); 
        $tipoAtendimentos = tipoAtendimento::all();
        $statusAtendimentos = statusAtendimento::all();

        return view('form_relat_atendimento',compact('pessoas','tipoAtendimentos','statusAtendimentos','mostrarTodos','cidades','estados','bairros'));
    }

    public function pesquisaAtendimento(Request $request, atendimento $atendimento){ //pesquisa e retorna os atendimentos em pdf ou na pagina
        switch ($request->input('action')) {
            case 'relatorio':
                $dataform = $request->input('dataform');
                //dd($dataform);
                $atendimentos = $atendimento->pesquisaPdf($dataform);        
                $agentePolitico = agentePolitico::first();

                //GERAR PDF CASO TENHA TIDO BUSCA DE ENDEREÇO
                if(isset($dataform['nom_estado'])){                                                  //Quando esta sendo paginada, pode não ter sido pesquisado um estado, por isto ele pode não existir
                    if($dataform['nom_estado']!=null){                                                  
                        $atendimentoEstado=[];                                                        //array que recebera os resultados da busca por estado       
                        foreach ($atendimentos as $atendimento) {                                       //para todos atendimentos retornados pela busca
                            if(isset($atendimento->pessoa->nom_estado)){                              //se existir uma pessoa que possua uma cidade
                                if($dataform['nom_estado'] === $atendimento->pessoa->nom_estado){     //e se o nome da cidade for igual da da busca
                                    $atendimentoEstado[]= $atendimentos;                               //então o array recebe o atendimento que tem a cidade buscada 
                                }
                            }
                        }
                    }else{
                        $atendimentoEstado=$atendimentos;                                    //caso não tenha sido buscado por nenhum estado recebe a busca geral 
                    }    
                }else{
                    $atendimentoEstado=$atendimentos;
                }               

                if(isset($dataform['nom_cidade'])){                                                  //Quando esta sendo paginada, pode não ter sido pesquisado uma cidade, por isto ele pode não existir
                    if($dataform['nom_cidade']!=null){                                                  
                        $atendimentosCidade=[];                                                         //array que recebera os resultados da busca por cidade
                        foreach ($atendimentoEstado as $atendimento) {                                  //para todos atendimentos retornados pela busca
                            if(isset($atendimento->pessoa->nom_cidade)){                                // se existir uma pessoa que possua uma cidade
                                if($dataform['nom_cidade'] === $atendimento->pessoa->nom_cidade){       // e se o nome da cidade for igual da da busca
                                    $atendimentosCidade[]= $atendimento;                                // então o array recebe o atendimento que tem a cidade buscada 
                                }
                            }
                        }
                    }else{                                                                              //caso não tenha sido buscado por nenhuma cidade                                                                        //se não foi buscado por nenhum estado
                        $atendimentosCidade=$atendimentoEstado;                                    //recebe a busca por estado
                    }
                }else{
                    $atendimentosCidade=$atendimentoEstado; 
                }

                if(isset($dataform['nom_bairro'])){                                              //Quando esta sendo paginada, pode não ter sido pesquisado um bairro, por isto ele pode não existir                
                    if($dataform['nom_bairro']!=null){                                                 
                        $atendimentosBairro=[];                                                       //Array que recebe a busca por bairro
                        foreach ($atendimentosCidade as $atendimento) {                               //para todos atendimentos retornados pela busca
                            if(isset($atendimento->pessoa->nom_bairro)){                              // se existir uma pessoa que possua uma cidade
                                if($dataform['nom_bairro'] === $atendimento->pessoa->nom_bairro){     // e se o nome da cidade for igual da da busca
                                    $atendimentosBairro[] = $atendimento;                             // então o array recebe o atendimento que tem o bairro buscado 
                                }
                            }
                        }
                    }else{                                                                    //se não foi buscado por nenhum bairro
                            $atendimentosBairro=$atendimentosCidade;                          //então recebe a busca geral                    
                    }
                }else{
                    $atendimentosBairro=$atendimentosCidade; 
                }

                $atendimentos = $atendimentosBairro;                                      //no final $atendimentosBairro vai ter todas busca realizadas, ou o resultado da busca gera                        
                $pdf = PDF::loadView('pdf/pdfAtendimentoGeral',compact('agentePolitico','atendimentos')); 
                $pdf->getDOMPdf()->set_option('isPhpEnabled', true); 
                return $pdf->setPaper('a4')->stream('atendimentos.pdf');
            break;
            case 'pesquisa':
                //dd($dataform);
                //refazer
                $pessoas = pessoa::all();
                $pessoasCidade = pessoa::distinct()->whereNotNull('nom_cidade')->get(['nom_cidade']);
                $cidades = array();
                $pessoasBairro = pessoa::distinct()->whereNotNull('nom_bairro')->get(['nom_bairro']);
                $bairros = array();
                $pessoasEstados = pessoa::distinct()->whereNotNull('nom_estado')->get(['nom_estado']);
                $estados = array();
                foreach($pessoasCidade as $pessoa){
                    array_push($cidades, $pessoa->nom_cidade);
                }
                foreach($pessoasBairro as $pessoa){
                    array_push($bairros, $pessoa->nom_bairro);
                }
                foreach($pessoasEstados as $pessoa){
                    array_push($estados, $pessoa->nom_estado);
                }
                $pesquisaEndereco = false;
                $dataform = $request->except('_token');
                $atendimentos = $atendimento->pesquisaPaginada($dataform);
                //dd($atendimentos);
                $pessoas = pessoa::all(); 
                $tipoAtendimentos = tipoAtendimento::all();
                $statusAtendimentos = statusAtendimento::all();
                $mostrarTodos = true;
                return view('form_relat_atendimento',compact('pessoas','tipoAtendimentos','statusAtendimentos','mostrarTodos','atendimentos','dataform','cidades','bairros','estados','pesquisaEndereco'));     
            break;
            case 'pesquisaEndereco':
                //refazer
                $pessoas = pessoa::all();
                $pessoasCidade = pessoa::distinct()->whereNotNull('nom_cidade')->get(['nom_cidade']);
                $cidades = array();
                $pessoasBairro = pessoa::distinct()->whereNotNull('nom_bairro')->get(['nom_bairro']);
                $bairros = array();
                $pessoasEstados = pessoa::distinct()->whereNotNull('nom_estado')->get(['nom_estado']);
                $estados = array();
                foreach($pessoasCidade as $pessoa){
                    array_push($cidades, $pessoa->nom_cidade);
                }
                foreach($pessoasBairro as $pessoa){
                    array_push($bairros, $pessoa->nom_bairro);
                }
                foreach($pessoasEstados as $pessoa){
                    array_push($estados, $pessoa->nom_estado);
                }
                //fim de refazer
                $dataform = $request->except('_token');
                $pesquisaEndereco = true;
                $atendimentoSemEndereco = $atendimento->pesquisaPdf($dataform);     //o método pesquisa PDF vai retornar todos registros que tenham os campos pesquisados - menos os de endereço - sem cortar em paginas
                //dd($dataform);
                if(isset($dataform['nom_estado'])){                                                  //Quando esta sendo paginada, pode não ter sido pesquisado um estado, por isto ele pode não existir
                    if($dataform['nom_estado']!=null){                                                  
                        $atendimentoEstado=[];                                                        //array que recebera os resultados da busca por estado       
                        foreach ($atendimentoSemEndereco as $atendimento) {                           //para todos atendimentos retornados pela busca
                            if(isset($atendimento->pessoa->nom_estado)){                              //se existir uma pessoa que possua uma cidade
                                if($dataform['nom_estado'] === $atendimento->pessoa->nom_estado){     //e se o nome da cidade for igual da da busca
                                    $atendimentoEstado[]= $atendimento;                               //então o array recebe o atendimento que tem a cidade buscada 
                                }
                            }
                        }
                    }else{
                        $atendimentoEstado=$atendimentoSemEndereco;                                    //caso não tenha sido buscado por nenhum estado recebe a busca geral 
                    }    
                }else{
                    $atendimentoEstado=$atendimentoSemEndereco;
                }               

                if(isset($dataform['nom_cidade'])){                                                  //Quando esta sendo paginada, pode não ter sido pesquisado uma cidade, por isto ele pode não existir
                    if($dataform['nom_cidade']!=null){                                                  
                        $atendimentosCidade=[];                                                         //array que recebera os resultados da busca por cidade
                        foreach ($atendimentoEstado as $atendimento) {                                  //para todos atendimentos retornados pela busca
                            if(isset($atendimento->pessoa->nom_cidade)){                                // se existir uma pessoa que possua uma cidade
                                if($dataform['nom_cidade'] === $atendimento->pessoa->nom_cidade){       // e se o nome da cidade for igual da da busca
                                    $atendimentosCidade[]= $atendimento;                                // então o array recebe o atendimento que tem a cidade buscada 
                                }
                            }
                        }
                    }else{                                                                              //caso não tenha sido buscado por nenhuma cidade                                                                        //se não foi buscado por nenhum estado
                        $atendimentosCidade=$atendimentoEstado;                                    //recebe a busca por estado
                    }
                }else{
                    $atendimentosCidade=$atendimentoEstado; 
                }

                if(isset($dataform['nom_bairro'])){                                              //Quando esta sendo paginada, pode não ter sido pesquisado um bairro, por isto ele pode não existir                
                    if($dataform['nom_bairro']!=null){                                                 
                        $atendimentosBairro=[];                                                       //Array que recebe a busca por bairro
                        foreach ($atendimentosCidade as $atendimento) {                               //para todos atendimentos retornados pela busca
                            if(isset($atendimento->pessoa->nom_bairro)){                              // se existir uma pessoa que possua uma cidade
                                if($dataform['nom_bairro'] === $atendimento->pessoa->nom_bairro){     // e se o nome da cidade for igual da da busca
                                    $atendimentosBairro[] = $atendimento;                             // então o array recebe o atendimento que tem o bairro buscado 
                                }
                            }
                        }
                    }else{                                                                    //se não foi buscado por nenhum bairro
                            $atendimentosBairro=$atendimentosCidade;                          //então recebe a busca geral                    
                    }
                }else{
                    $atendimentosBairro=$atendimentosCidade; 
                }

                $atendimentosBairro;                                      //no final $atendimentosBairro vai ter todas busca realizadas, ou o resultado da busca gera

                $myCollectionObj = collect($atendimentosBairro);
  
                $atendimentos = $this->paginate($myCollectionObj);        

                $pessoas = pessoa::all(); 
                $tipoAtendimentos = tipoAtendimento::all();
                $statusAtendimentos = statusAtendimento::all();
                $mostrarTodos = true;
                return view('form_relat_atendimento',compact('pessoas','tipoAtendimentos','statusAtendimentos','mostrarTodos','atendimentos','dataform','cidades','bairros','estados','pesquisaEndereco')); 
                
            break;
            case 'relatorioExcel':
                return Excel::download(new atendimentosExport, 'atendimento.xlsx');
            break;
        }      
    }
    public function pesquisaDocumento(Request $request, documento $documento){
        switch ($request->input('action')) {
            case 'relatorio':
                $dataform = $request->input('dataform');
                $documentos = $documento->pesquisaPdf($dataform);        
                $agentePolitico = agentePolitico::first();
                $pdf = PDF::loadView('pdf/pdfDocumentoGeral',compact('agentePolitico','documentos'));
                $pdf->getDOMPdf()->set_option('isPhpEnabled', true); 
                return $pdf->setPaper('a4')->stream('documentos.pdf');
            break;
            case 'pesquisar':
                $dataform = $request->except('_token');
                $documentos = $documento->pesquisaPaginada($dataform);
                $mostrarTodos = true;
                $pessoas = pessoa::all();
                $tipoDocumento = tipoDocumento::all();
                $situacaoDoc = situacaoDoc::all();
                $unidadeDocumento = unidadeDocumento::all();
                ///Linha 74 e 75 rever se é bug
                $tipoAtendimento = tipoAtendimento::all();
                $statusAtendimento = statusAtendimento::all();
                return view('form_relat_documento',compact('documentos','mostrarTodos','dataform','pessoas','tipoDocumento','situacaoDoc','unidadeDocumento','tipoAtendimento','statusAtendimento')); 
            break;
            case 'relatorioExcel':
                return Excel::download(new documentosExport, 'documento.xlsx');
            break;
        }        
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function paginate($items, $perPage = 5, $page = null, $options = ["path"=>"/relatorio/pesquisaAtendimento"])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}

