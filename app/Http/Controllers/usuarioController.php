<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;//classe de hash para senha

class usuarioController extends Controller
{
    private $usuario;

    public function __construct(User $usuario){
        $this->middleware('auth'); 
        $this->usuario = $usuario;
    }

    public function index(){
        //$usuario = $this->usuario->where('id',$id); //recupera o primeiro id
        return view('form_config');
    }
    
    public function edit($id){
        $usuario = $this->usuario->where('id',$id); //recupera o primeiro id

        return view('form_config',compact('usuario'));
    }

    public function update($id , Request $request){
        $usuario = User::findOrFail($id);
        $dataForm = $request->all();
        
        if($dataForm['corSystem'] == null){
            $dataForm['corSystem'] = $usuario->corSystem;
        }
        /*if($dataForm['corSystem'] == null){
            $dataForm['corSystem'] = $usuario->corSystem;
        }*/
        if($dataForm['password']==null){
            $dataForm['password'] = $usuario->password;
        }else{
            $dataForm['password']= Hash::make($dataForm['password']);
        }

        //dd($dataForm);

        $usuario->update($dataForm);

        return redirect()
                    ->route('usuario.index')
                    ->with('success', 'Configurações e usuário alterado com sucesso!');
    }

    public function disableHelpIni(Request $request)
    {
        //dd($request['id']);
        $usuario = User::find($request['id']);
        $array['ajuda_inicio']=false;
        $usuario->update($array);
        
        return redirect()->back();
    }

    public function disableHelpPessoa(Request $request)
    {
        $usuario = User::findOrFail($request['id']);
        $array['ajd_pessoa']=false;
        $usuario->update($array);

        return redirect()->back();
    }

    public function disableHelpDocumento(Request $request)
    {
        $usuario = User::findOrFail($request['id']);
        $array['ajd_documento']=false;
        $usuario->update($array);

        return redirect()->back();
    }

    public function disableHelpAtendimento(Request $request)
    {
        $usuario = User::findOrFail($request['id']);
        $array['ajd_atendimento']=false;
        $usuario->update($array);

        return redirect()->back();
    }

}
