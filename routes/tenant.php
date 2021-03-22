<?php

use Illuminate\Support\Facades\Route;


//Rota para setar o banco a partir do dominio
Route::any('/setaBanco','Tenant\TenantController@setaBanco')->name('tenant.setaBanco');

//rotas de previlegio para criar tenants
Route::get('/',function(){
    return 'este';
});

//Rota da criação de gabinetes
//Route::resource('/organizacao', 'Tenant\OrganizacaoController');
Route::resource('/organizacao', 'Tenant\OrganizacaoController');

Route::post('/usuario/reset', 'Tenant\tenantUsuarioController@resetSenha')->name('usuario.reset');
Route::get('/usuario/padrao/{domain}', 'Tenant\tenantUsuarioController@cadUsuariosPadrao')->name('usuarios.padrao.cadastro');
Route::post('/usuario/delete', 'Tenant\tenantUsuarioController@excluirUsuario')->name('usuario.exclusao');
Route::post('/usuario/cadastro', 'Tenant\tenantUsuarioController@cadastrarUsuario')->name('usuario.cadastro');

Route::put('/usuario/configuracao/{id}', 'Tenant\TenantController@alterarUsuario')->name('usuario.alterar');
Route::get('/usuario/configuracao/{id}', 'Tenant\TenantController@editarUsuario')->name('usuario.editar');
Route::get('/tenants', 'Tenant\TenantController@index')->name('tenant.index');

Route::get('/estatisticas', 'Tenant\EstatisticasController@index')->name('tenant.estatisticas.index');
Route::post('/estatisticas/pesquisaEstatistica','Tenant\EstatisticasController@pesquisaEstatisticas')->name('estatisticas.pesquisa');


Route::get('/backup', 'Tenant\BackupController@index')->name('tenant.backup.index');