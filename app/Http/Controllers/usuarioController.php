<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;//classe de hash para senha

class usuarioController extends Controller
{
    private $ususario;

    public function __construct(User $ususario){
        $this->middleware('auth'); 
        $this->ususario = $ususario;
    }

    public function index(){
        //$ususario = $this->ususario->where('id',$id); //recupera o primeiro id
        return view('form_config');
    }
    
    public function edit($id){
        $ususario = $this->ususario->where('id',$id); //recupera o primeiro id

        return view('form_config',compact('ususario'));
    }

    public function update($id , Request $request){
        $ususario = User::findOrFail($id);
        $dataForm = $request->all();
        
        if($dataForm['corSystem'] == null){
            $dataForm['corSystem'] = 'blue-grey';
        }
        /*if($dataForm['corSystem'] == null){
            $dataForm['corSystem'] = $ususario->corSystem;
        }*/
        if($dataForm['password']==null){
            $dataForm['password'] = $ususario->password;
        }else{
            $dataForm['password']= Hash::make($dataForm['password']);
        }

        //dd($dataForm);

        $ususario->update($dataForm);

        return redirect()
                    ->route('usuario.index')
                    ->with('success', 'Configurações e usuário alterado com sucesso!');
    }

    public function disableHelpIni(Request $request)
    {
        $ususario = User::findOrFail($request['id']);
        $array['ajuda_inicio']=false;
        $ususario->update($array);

        return redirect()->back();
    }

    public function disableHelpPessoa(Request $request)
    {
        $ususario = User::findOrFail($request['id']);
        $array['ajd_pessoa']=false;
        $ususario->update($array);

        return redirect()->back();
    }

    public function disableHelpDocumento(Request $request)
    {
        $ususario = User::findOrFail($request['id']);
        $array['ajd_documento']=false;
        $ususario->update($array);

        return redirect()->back();
    }

    public function disableHelpAtendimento(Request $request)
    {
        $ususario = User::findOrFail($request['id']);
        $array['ajd_atendimento']=false;
        $ususario->update($array);

        return redirect()->back();
    }

}
