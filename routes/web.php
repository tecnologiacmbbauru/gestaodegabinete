<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/404-tenant', function() {
    return view('errors.404-tenant');
})->name('404.tenant');


Auth::routes(['register' => false]); //rotas de autenticação sem registro

Route::post('/login','LoginController@authenticate')->name('login.tenant');

/*HELPS*/
Route::resource('/usuario','usuarioController');
Route::get('/usuarioI','usuarioController@disableHelpIni')->name('usuario.disableHelpIni');
Route::get('/usuarioP','usuarioController@disableHelpPessoa')->name('usuario.disableHelpPessoa');
Route::get('/usuarioD','usuarioController@disableHelpDocumento')->name('usuario.disableHelpDocumento');
Route::get('/usuarioA','usuarioController@disableHelpAtendimento')->name('usuario.disableHelpAtendimento');


//ROTAS DA ABA CADASTRO//
Route::resource('/statusAtendimento', 'StatusAtendimentoController');

Route::resource('/tipoAtendimento', 'TipoAtendimentoController');

Route::resource('/tipoDocumento', 'TipoDocumentoController');

Route::resource('/situacaoDoc', 'SituacaoDocController');

Route::resource('/unidadeDocumento', 'UnidadeDocumentoController');

Route::resource('/cargoPolitico', 'CargoPoliticoController');

Route::resource('/chaveAgenda','ChaveAgendaController');

Route::get('/agenda','AgendaController@index')->name('agenda');

Route::resource('/agentePolitico', 'AgentePoliticoController');
Route::post('/agentePolitico/altera', 'AgentePoliticoController@altera')->name('agentePolitico.altera');

//Rotas da navbar
Route::post('/pessoa/tirarFoto','PessoaController@tirarFoto')->name('pessoa.tirarFoto');
Route::any('/pessoa/pesquisa/relatorio/{var}','PessoaController@pessoaRelatorio')->name('pessoa.pessoaRelatorio');
Route::any('/pessoa/pesquisa','PessoaController@pesquisaPessoa')->name('pessoa.pesquisaPessoa');
Route::resource('/pessoa','PessoaController');

Route::any('/atendimento/pesquisaAtendimento','AtendimentoController@pesquisaAtendimento')->name('atendimento.pesquisaAtendimento');
Route::post('/atendimento/seleciona_pessoa','AtendimentoController@seleciona_pessoa')->name('atendimento.seleciona_pessoa');
Route::resource('/atendimento','AtendimentoController');

Route::any('/documento/pesquisaDocumento','DocumentoController@pesquisaDocumento')->name('documento.pesquisaDocumento');
Route::post('/documento/pesqAtendimento','DocumentoController@pesqAtendimento')->name('documento.pesqAtendimento');
Route::post('/documento/cadAtendimento','DocumentoController@cadAtendimento')->name('documento.cadAtendimento');
Route::resource('/documento','DocumentoController');

/*Rotas de Relatório */
Route::any('/relatorio/pessoa','pdfController@relatorioPessoa')->name('relatorio.Pessoa');
Route::any('/relatorio/pesquisaDocumento','pdfController@pesquisaDocumento')->name('relatorio.pesquisaDocumento');
Route::any('/relatorio/documento','pdfController@retornaDocumento')->name('relatorio.retornaDocumento');
Route::any('/relatorio/pesquisaAtendimento','pdfController@pesquisaAtendimento')->name('relatorio.pesquisaAtendimento');
Route::get('/relatorio/atendimento','pdfController@retornaAtendimento')->name('relatorio.retornaAtendimento');
Route::get('/pdf/{id}','pdfController@geraPdfAtendimento')->name('pdf.atendimento');

/*Etiqueta de Aniversario*/
Route::get('/etiquetaAniversario','EtiquetaController@index')->name('relatorio.retornaEtiqueta');
Route::any('/etiquetaAniversarioResultado','EtiquetaController@pesquisaAniversario')->name('relatorio.pesquisaAniversario');
Route::any('/etiquetaAniversarioImpressao','EtiquetaController@imprimeEtiqueta')->name('relatorio.imprimeEtiqueta');

//Rotas
Route::get('/','HomeController@index')->name('index');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/sobre' , 'sobreController@index')->name('sobre');

Route::get('/manual' , 'manualController@index')->name('manual');        

Route::get('/lembretes' , 'LembreteController@index')->name('lembretes.index');
Route::any('/lembretes/pesquisa/' , 'LembreteController@lembretePesquisa')->name('lembrete.pesquisa');
Route::get('/lembretes/delete/{id}/{acao}' , 'LembreteController@delete')->name('lembrete.delete');
