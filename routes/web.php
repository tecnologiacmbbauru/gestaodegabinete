<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\StatusAtendimentoController;
use App\Http\Controllers\TipoAtendimentoController;
use App\Http\Controllers\TipoDocumentoController;
use App\Http\Controllers\SituacaoDocController;
use App\Http\Controllers\UnidadeDocumentoController;
use App\Http\Controllers\CargoPoliticoController;
use App\Http\Controllers\ChaveAgendaController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AgentePoliticoController;
use App\Http\Controllers\PessoaController;
use App\Http\Controllers\AtendimentoController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\EtiquetaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SobreController;
use App\Http\Controllers\ManualController;
use App\Http\Controllers\DownloadsController;
use App\Http\Controllers\LembreteController;

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

Route::post('/login', [LoginController::class, 'authenticate'])->name('login.tenant');

/*HELPS*/
Route::resource('/usuario', UsuarioController::class);
Route::get('/usuarioI', [UsuarioController::class, 'disableHelpIni'])->name('usuario.disableHelpIni');
Route::get('/usuarioP', [UsuarioController::class, 'disableHelpPessoa'])->name('usuario.disableHelpPessoa');
Route::get('/usuarioD', [UsuarioController::class, 'disableHelpDocumento'])->name('usuario.disableHelpDocumento');
Route::get('/usuarioA', [UsuarioController::class, 'disableHelpAtendimento'])->name('usuario.disableHelpAtendimento');


//ROTAS DA ABA CADASTRO//
Route::resource('/statusAtendimento', StatusAtendimentoController::class);

Route::resource('/tipoAtendimento', TipoAtendimentoController::class);

Route::resource('/tipoDocumento', TipoDocumentoController::class);

Route::resource('/situacaoDoc', SituacaoDocController::class);

Route::resource('/unidadeDocumento', UnidadeDocumentoController::class);

Route::resource('/cargoPolitico', CargoPoliticoController::class);

Route::resource('/chaveAgenda',ChaveAgendaController::class);

Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda');

Route::resource('/agentePolitico', AgentePoliticoController::class);
Route::post('/agentePolitico/altera', [AgendaController::class, 'altera'])->name('agentePolitico.altera');

//Rotas da navbar
Route::post('/pessoa/tirarFoto', [PessoaController::class, 'tirarFoto'])->name('pessoa.tirarFoto');
Route::any('/pessoa/pesquisa/relatorio/{var}', [PessoaController::class, 'pessoaRelatorio'])->name('pessoa.pessoaRelatorio');
Route::any('/pessoa/pesquisa', [PessoaController::class, 'pesquisaPessoa'])->name('pessoa.pesquisaPessoa');
Route::resource('/pessoa', PessoaController::class);

Route::any('/atendimento/pesquisaAtendimento', [AtendimentoController::class, 'pesquisaAtendimento'])->name('atendimento.pesquisaAtendimento');
Route::post('/atendimento/seleciona_pessoa', [AtendimentoController::class, 'seleciona_pessoa'])->name('atendimento.seleciona_pessoa');
Route::resource('/atendimento', AtendimentoController::class);

Route::any('/documento/pesquisaDocumento', [DocumentoController::class, 'pesquisaDocumento'])->name('documento.pesquisaDocumento');
Route::post('/documento/pesqAtendimento', [DocumentoController::class, 'pesqAtendimento'])->name('documento.pesqAtendimento');
Route::post('/documento/cadAtendimento', [DocumentoController::class, 'cadAtendimento'])->name('documento.cadAtendimento');
Route::resource('/documento', DocumentoController::class);

/*Rotas de Relatório */
Route::any('/relatorio/pessoa', [PdfController::class, 'relatorioPessoa'])->name('relatorio.Pessoa');
Route::any('/relatorio/pesquisaDocumento', [PdfController::class, 'pesquisaDocumento'])->name('relatorio.pesquisaDocumento');
Route::any('/relatorio/documento', [PdfController::class, 'retornaDocumento'])->name('relatorio.retornaDocumento');
Route::any('/relatorio/pesquisaAtendimento', [PdfController::class, 'pesquisaAtendimento'])->name('relatorio.pesquisaAtendimento');
Route::get('/relatorio/atendimento', [PdfController::class, 'retornaAtendimento'])->name('relatorio.retornaAtendimento');
Route::get('/pdf/{id}', [PdfController::class, 'geraPdfAtendimento'])->name('pdf.atendimento');

/*Etiqueta de Aniversario*/
Route::get('/etiquetaAniversario', [EtiquetaController::class, 'index'])->name('relatorio.retornaEtiqueta');
Route::any('/etiquetaAniversarioResultado', [EtiquetaController::class, 'pesquisaAniversario'])->name('relatorio.pesquisaAniversario');
Route::any('/etiquetaAniversarioImpressao', [EtiquetaController::class, 'imprimeEtiqueta'])->name('relatorio.imprimeEtiqueta');

//Rotas
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/sobre' , [SobreController::class, 'index'])->name('sobre');

Route::get('/manual' , [ManualController::class, 'index'])->name('manual');

Route::get('/downloads' , [DownloadsController::class, 'index'])->name('downloads');

Route::get('/lembretes' , [LembreteController::class, 'index'])->name('lembretes.index');
Route::any('/lembretes/pesquisa/' , [LembreteController::class, 'lembretePesquisa'])->name('lembrete.pesquisa');
Route::get('/lembretes/delete/{id}/{acao}' , [LembreteController::class, 'delete'])->name('lembrete.delete');
