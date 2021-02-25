<?php

namespace App\Http\Controllers\Tenant;

use App\Events\Tenant\DatabaseCreated;
use App\Events\Tenant\CompanyCreated;
use App\Models\Organizacao;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrganizacaoController extends Controller
{
    private $organizacao;

    public function __construct(Organizacao $organizacao)
    {
        $this->organizacao = $organizacao;
    }

    public function index()
    {
        return "aqui";
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        
        $organizacao = $this->organizacao->create([
            'name' => "Gabinete".Str::random(5),
            'domain' => Str::random(5)."gabinete.com",
            'bd_database' => "gab02".Str::random(5) ,
            'bd_hostname' =>"localhost",
            'bd_username' =>"root",
            'bd_password' =>"root",
        ]);

        
        if (true)
            event(new CompanyCreated($organizacao));//evento para criação do banco de dados
        else
            event(new DatabaseCreated($organizacao));

        dd($organizacao);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
