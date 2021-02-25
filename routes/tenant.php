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
Route::get('/organizacao', 'Tenant\OrganizacaoController@store')->name('organizacao.store');

