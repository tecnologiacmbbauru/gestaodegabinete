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
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator; //Paginação Manual


//Importações para pegar a url da paginação
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Config;

class pdfController extends Controller
{

    public function relatorioPessoa(Request $request, pessoa $pessoa) {
        switch ($request->input('action')) {
            case 'relatorioExcel':
                $dataform = $request->input('dataform');
                $pessoas = $pessoa->pesquisaLimitada($dataform);  
                
                //log
                Log::channel('relatorios')->info('Relatorio de PESSOA em EXCEL gerado no Gabinete: '.auth()->user()->domain.' |pelo usuario: '.auth()->user()->name.'(id='.auth()->user()->id.')  |Numero de registros impressos:'.$pessoas->count());

                return Excel::download(new pessoasExport($pessoas), 'pessoa.xlsx');
                //return Excel::download(new atendimentosExport, 'atendimento.xlsx');
            break;
            default:
                $dataform = $request->input('dataform');
                $pessoas = $pessoa->pesquisaLimitada($dataform);        
                $agentePolitico = agentePolitico::first();
                
                //log
                Log::channel('relatorios')->info('Relatorio de PESSOA em PDF gerado no Gabinete: '.auth()->user()->domain.' |pelo usuario: '.auth()->user()->name.'(id='.auth()->user()->id.') |Numero de registros impressos:'.$pessoas->count());

                $pdf = PDF::loadView('pdf/pdfRelatorioPessoa',compact('agentePolitico','pessoas'));//->setOption('footer-right','"page [page] of [topage]"');
                return $pdf->stream('pessoa.pdf');
            break;
        }
    }

    public function geraPdfAtendimento($id){ //gera PDF de um unico antedimento

        $atendimentos = atendimento::findOrFail($id);
        $agentePolitico = agentePolitico::first();
        
        $pdf = PDF::loadView('pdf/pdfAtendimento',compact('agentePolitico','atendimentos'));
        
        return $pdf->stream('atendimento.pdf');
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
        $pessoasCidade = pessoa::distinct()->whereNotNull('nom_cidade')->orderBy('nom_cidade')->get(['nom_cidade']);
        $cidades = array();
        $pessoasBairro = pessoa::distinct()->whereNotNull('nom_bairro')->orderBy('nom_bairro')->get(['nom_bairro']);
        $bairros = array();
        $pessoasEstados = pessoa::distinct()->whereNotNull('nom_estado')->orderBy('nom_estado')->get(['nom_estado']);
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
                $atendimentos = $atendimento->pesquisaLimitada($dataform);        
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
                
                Log::channel('relatorios')->info('Relatorio de ATENDIMENTO em PDF gerado no Gabinete: '.auth()->user()->domain.' |pelo usuario: '.auth()->user()->name.'(id='.auth()->user()->id.') |Numero de registros impressos:'.$atendimentos->count());
                
                $pdf = PDF::loadView('pdf/pdfAtendimentoGeral',compact('agentePolitico','atendimentos')); 
                return $pdf->stream('atendimentos.pdf');
            break;
            case 'pesquisa':
                //refazer
                $pessoas = pessoa::all();
                $pessoasCidade = pessoa::distinct()->whereNotNull('nom_cidade')->orderBy('nom_cidade')->get(['nom_cidade']);
                $cidades = array();
                $pessoasBairro = pessoa::distinct()->whereNotNull('nom_bairro')->orderBy('nom_bairro')->get(['nom_bairro']);
                $bairros = array();
                $pessoasEstados = pessoa::distinct()->whereNotNull('nom_estado')->orderBy('nom_estado')->get(['nom_estado']);
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
                $atendimentos = $atendimento->pesquisaLimitada($dataform);
                $atendimentos = $atendimentos->paginate(20)->onEachSide(1);
                $atendimentos->withPath(config('app.url')."/relatorio/pesquisaAtendimento");
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
                $pessoasCidade = pessoa::distinct()->whereNotNull('nom_cidade')->orderBy('nom_cidade')->get(['nom_cidade']);
                $cidades = array();
                $pessoasBairro = pessoa::distinct()->whereNotNull('nom_bairro')->orderBy('nom_bairro')->get(['nom_bairro']);
                $bairros = array();
                $pessoasEstados = pessoa::distinct()->whereNotNull('nom_estado')->orderBy('nom_estado')->get(['nom_estado']);
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
                $atendimentoSemEndereco = $atendimento->pesquisa($dataform);     //o método pesquisa PDF vai retornar todos registros que tenham os campos pesquisados - menos os de endereço - sem cortar em paginas
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
                $atendimentos->withPath(config('app.url')."/relatorio/pesquisaAtendimento");
                //dd($myCollectionObj);
                
                
                //dd($atendimentos);
                $pessoas = pessoa::all(); 
                $tipoAtendimentos = tipoAtendimento::all();
                $statusAtendimentos = statusAtendimento::all();
                $mostrarTodos = true;
                return view('form_relat_atendimento',compact('pessoas','tipoAtendimentos','statusAtendimentos','mostrarTodos','atendimentos','dataform','cidades','bairros','estados','pesquisaEndereco')); 
                
            break;
            case 'relatorioExcel':
                $dataform = $request->input('dataform');
                //dd($dataform);
                $atendimentos = $atendimento->pesquisaLimitada($dataform);        
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
                //dd($atendimentos);
                
                Log::channel('relatorios')->info('Relatorio de ATENDIMENTO em EXCEL gerado no Gabinete: '.auth()->user()->domain.' |pelo usuario: '.auth()->user()->name.'(id='.auth()->user()->id.') |Numero de registros impressos:'.$atendimentos->count());
                
                return Excel::download(new atendimentosExport($atendimentos), 'atendimento.xlsx');
            break;
        }      
    }

    public function pesquisaDocumento(Request $request, documento $documento){
        switch ($request->input('action')) {
            case 'relatorio':
                $dataform = $request->input('dataform');
                $documentos = $documento->pesquisaLimitada($dataform);         
                $agentePolitico = agentePolitico::first();

                Log::channel('relatorios')->info('Relatorio de DOCUMENTO em PDF gerado no Gabinete: '.auth()->user()->domain.' |pelo usuario: '.auth()->user()->name.'(id='.auth()->user()->id.') |Numero de registros impressos:'.$documentos->count());

                $pdf = PDF::loadView('pdf/pdfDocumentoGeral',compact('agentePolitico','documentos'));

                return $pdf->stream('documentos.pdf');
            break;
            case 'pesquisar':
                $dataform = $request->except('_token');
                $documentos = $documento->pesquisaLimitada($dataform);
                $documentos = $documentos->paginate(20)->onEachSide(1);
                $documentos->withPath(config('app.url')."/relatorio/pesquisaDocumento");
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
                $dataform = $request->input('dataform');
                $documentos = $documento->pesquisaLimitada($dataform);

                Log::channel('relatorios')->info('Relatorio de DOCUMENTO em EXCEL gerado no Gabinete: '.auth()->user()->domain.' |pelo usuario: '.auth()->user()->name.'(id='.auth()->user()->id.') |Numero de registros impressos:'.$documentos->count());

                return Excel::download(new documentosExport($documentos), 'documento.xlsx');
            break;
        }        
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    public function paginate($items, $perPage = 20, $page = null, $options = ["path"=>"/relatorio/pesquisaAtendimento"])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

}