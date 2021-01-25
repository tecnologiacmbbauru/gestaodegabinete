<?php

namespace App\Http\Controllers;

use App\Models\pessoa;
use Illuminate\Http\Request;

class PessoaController extends Controller
{

    private $pessoaC; //contrutor de pessoa


    public function __construct(pessoa $pessoaC){
        $this->middleware('auth'); //verificar se o usuario esta logado

        $this->pessoaC = $pessoaC;
    }


    public function index()
    {
        $alteracao=false;
        $pessoa = $this->pessoaC->paginate(20);
        return view('form_pessoa',compact('alteracao','pessoa'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
                $dataform = $request->all();

                if($dataform['ind_status'] == NULL){
                    $dataform['ind_status'] == 'A';
                }
                
                if($request->hasFile('img_perfil') && $request->img_perfil->isValid()){
                    $imagePath = $request->img_perfil->store('pessoa');
                    $dataform['image']=$imagePath;
                }
                $dataform['nom_usuario_log'] = auth()->user()->name;
                //dd($dataform);
                $insert = $this->pessoaC->create($dataform);
                
                // Verifica se inseriu com sucesso
                // Redireciona para a listagem das categorias
                // Passa uma session flash success (sessão temporária)
                if ($insert)
                    return redirect()
                                ->route('pessoa.index')
                                ->with('success', 'Pessoa inserida com sucesso!');
            
                // Redireciona de volta com uma mensagem de erro
                return redirect()
                            ->back()
                            ->with('error', 'Falha ao inserir');
    
    }

    public function pesquisaPessoa(Request $request,pessoa $pessoaModel){
        $alteracao = false;
        $mostraPesq=true;
        $dataform = $request->except('_token','ind_status');
        $pessoa = $pessoaModel->pesquisaPaginada($dataform);
     
        //dd(gettype($dataform));
        return view('form_pessoa',compact('pessoa','alteracao','mostraPesq','dataform'));
    }

    public function show(pessoa $pessoa)
    {
        //
    }

 
    public function edit($id)
    {
 
        $alteracao = true;
        $pessoa = $this->pessoaC->paginate(15);
        $pessoaC = $this->pessoaC->where('cod_pessoa',$id)->first();
    
        return view('form_pessoa',compact('alteracao','pessoaC','pessoa'));
    }

    public function update($id , Request $request)
    {
        //dd($request->all());
        $pessoaC = pessoa::findOrFail($id);
        if($request->hasFile('img_perfil') && $request->img_perfil->isValid()){
            $imagePath = $request->img_perfil->store('pessoa');
            $pessoaC['image']=$imagePath;
        }
        $pessoaC->update($request->all());

        return redirect()
                    ->route('pessoa.index')
                    ->with('success', 'Pessoa Alterada com sucesso!');
    }


    public function destroy(Request $request)
    {
        $pessoaC = pessoa::findOrFail($request->id_exclusao);
        //$pessoaC = $pessoaC->delete(); //excluir de verdade
        $inativo = array('ind_status'=> 'I');
        $pessoaC->update($inativo);

        return redirect()
                    ->route('pessoa.index')
                    ->with('success', 'Pessoa excluída com sucesso!');

        // Redireciona de volta com uma mensagem de erro
        //return redirect()
         //           ->back()
         //           ->with('error', 'Erro ao excluir.');
    }
}
