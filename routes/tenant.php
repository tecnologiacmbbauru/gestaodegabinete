<?php

use Illuminate\Support\Facades\Route;

//rotas de previlegio para criar tenants
Route::get('/',function(){
    return 'este';
});

//Rota da criação de gabinetes
//Route::resource('/organizacao', 'Tenant\OrganizacaoController');
Route::get('/organizacao', 'Tenant\OrganizacaoController@store')->name('organizacao.store');

