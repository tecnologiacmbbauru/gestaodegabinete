<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Tenant\TenantController;
use App\Http\Controllers\Tenant\OrganizacaoController;
use App\Http\Controllers\Tenant\TenantUsuarioController;
use App\Http\Controllers\Tenant\EstatisticasController;
use App\Http\Controllers\Tenant\BackupController;


//Rota para setar o banco a partir do dominio
Route::any('/setaBanco',[TenantController::class, 'setaBanco'])->name('tenant.setaBanco');

//rotas de previlegio para criar tenants
Route::get('/',function(){
    return 'teste';
});

//Rota da criação de gabinetes
//Route::resource('/organizacao', 'Tenant\OrganizacaoController');
Route::resource('/organizacao', OrganizacaoController::class);

Route::post('/usuario/reset', [TenantUsuarioController::class, 'resetSenha'])->name('usuario.reset');
Route::get('/usuario/padrao/{domain}', [TenantUsuarioController::class, 'cadUsuariosPadrao'])->name('usuarios.padrao.cadastro');
Route::post('/usuario/delete', [TenantUsuarioController::class, 'excluirUsuario'])->name('usuario.exclusao');
Route::post('/usuario/cadastro', [TenantUsuarioController::class, 'cadastrarUsuario'])->name('usuario.cadastro');

Route::put('/usuario/configuracao/{id}', [TenantController::class, 'alterarUsuario'])->name('usuario.alterar');
Route::get('/usuario/configuracao/{id}', [TenantController::class, 'editarUsuario'])->name('usuario.editar');
Route::get('/tenants', [TenantController::class, 'index'])->name('tenant.index');

Route::get('/manual', function () {
    return view('Tenants/manual');
})->name('tenant.manual.index');


Route::get('/estatisticas', [EstatisticasController::class, 'index'])->name('tenant.estatisticas.index');
Route::post('/estatisticas/pesquisaEstatistica',[EstatisticasController::class, 'pesquisaEstatisticas'])->name('estatisticas.pesquisa');


Route::get('/backup', [BackupController::class, 'index'])->name('tenant.backup.index');
