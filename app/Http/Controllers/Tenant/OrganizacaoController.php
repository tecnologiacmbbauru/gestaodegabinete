<?php

namespace App\Http\Controllers\Tenant;

use App\Events\Tenant\DatabaseCreated;
use App\Events\Tenant\CompanyCreated;
use App\Models\Organizacao;
use App\Http\Controllers\Controller;
use App\Events\Tenant\DatabaseDeleted;
use Dotenv\Result\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;//cripitografia da senha

class OrganizacaoController extends Controller
{
    private $organizacao;

    public function __construct(Organizacao $organizacao)
    {
        $this->organizacao = $organizacao;
    }

    public function index(Request $request)
    {
        $organizacoes = Organizacao::all();
        $acao  = $request->all();
        if($acao == null){
            return view('Tenants/form_organizacoes',compact('organizacoes')); 
        }else{
            if($acao['cadastro']==null){
                return view('Tenants/cad_organizacao'); 
            }
        }
        
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        ini_set('max_execution_time', 300); //Altera tempo maximo de requisição 5 minutes

        $dataform = $request->all();
        $dataform['domain'] = $dataform['bd_database'];
        $dataform['bd_password'] = Crypt::encryptString($dataform['bd_password']);

        try{
            if(isset($dataform['alterar-db'])===false){
                $dataform['bd_password'] = env('DB_PASSWORD');
                $dataform['bd_password'] = Crypt::encryptString($dataform['bd_password']);
            }

            $organizacao = $this->organizacao->create($dataform);

            if (isset($dataform['create_db'])){
                try{
                    event(new CompanyCreated($organizacao));//evento para criação do banco de dado
                } catch (\Exception $e) { //caso tenha um erro ao criar o banco, deleta o registro de organização que foi criado
                    $organizacao->delete();
                    return redirect()
                        ->route('organizacao.index')
                        ->with('error', 'Falha ao criar base dedados. Verifique se a base de dados já existe.');
                }
            }else{
                try{
                    event(new DatabaseCreated($organizacao));
                } catch (\Exception $e) {
                    $organizacao->delete();
                    return redirect()
                        ->route('organizacao.index')
                        ->with('error', 'Falha ao criar base dedados. Verifique se a base de dados já existe.');
                }
            }
            return redirect()
                        ->route('organizacao.show',$organizacao->id)
                        ->with('success', 'Cadastro de gabinete realizado com sucesso.');
        } catch (\Exception $e) {
            if($e->getCode()=="23000"){
                return redirect()
                ->route('organizacao.index')
                    ->with('error', 'Falha ao cadastrar. O campo dominio deve ser unico em cada gabinete.');
            }
            if($e->getCode()=="1049"){
                return redirect()
                ->route('organizacao.index')
                    ->with('error', 'A database selecionada não existe no banco de dados. Crie a database no banco de dados ou selecione para criar ao fazer o cadastro de um novo gabinete.');
            }
            else{
                return redirect()
                    ->route('organizacao.index')
                        ->with('error', 'Cadastro de gabinete não pode ser realizado.');
            }
        }


    }


    public function show($id)
    {
        $organizacao = Organizacao::find($id);
        
        $usuarios = User::where('domain',$organizacao->domain)->get();
        
        return view('Tenants/detalhes_organizacao',compact('organizacao','usuarios'));
    }


    public function edit($id)
    {
        $organizacao = Organizacao::find($id);
        return view('Tenants/alt_organizacao',compact('organizacao'));
    }


    public function update(Request $request, $id)
    {
        $organizacao = Organizacao::findOrFail($id);
        $dataform = $request->all();
        $dataform['bd_password'] = Crypt::encryptString($dataform['bd_password']);
        
        try{
            $organizacao->update($dataform);
            return redirect()
                        ->route('organizacao.index')
                        ->with('success', 'Gabinete atualizado com sucesso.');
        } catch (\Exception $e) {
                return redirect()
                    ->route('organizacao.index')
                        ->with('error', 'Falha em atualizar o gabinete.');
        }
    }


    public function destroy(Request $request, $id)
    {
        $organizacao = Organizacao::findOrFail($id);

        if($request->delete_bd == "on"){ //Verifica se é para deletar a base de dados
            try {
                event(new DatabaseDeleted($organizacao));
            } catch (\Exception $e){ 
                if($e->getCode()=="HY000"){
                    return redirect()
                    ->route('organizacao.index')
                    ->with('error', 'Não foi possivel excluir a database relacionada ao Gabinete '.$organizacao->name .' possivelmente a database' . $organizacao->bd_database .' não exista.'); 
                }else{
                    return redirect()
                        ->route('organizacao.index')
                        ->with('error', 'Não foi possivel excluir a database relacionada ao Gabinete '.$organizacao->name); 
                }     
            }
            User::where('domain',$organizacao->doamin)->delete();
        }
        //caso consiga deletar a base de dados (não retorne nenhum erro entrando no catch)
        //Então vou excluir todos usuarios relacionados e deletar o registro da organização...
        //...do database na databela Organizacaoes
        try {
            User::where('domain',$organizacao->domain)->delete();

            $organizacao->delete();
            
            return redirect()
                ->route('organizacao.index')
                ->with('success', 'Gabinete excluido com sucesso!');
            } catch (\Exception $e){ 
                return redirect()
                    ->route('organizacao.index')
                    ->with('error', 'Gabinete não pode ser excluido.'); 
            }   
        }

}
