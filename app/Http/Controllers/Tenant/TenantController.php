<?php

namespace App\Http\Controllers\Tenant;

use App\Models\Organizacao;
use App\Tenant\ManagerTenant;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TenantController extends Controller
{
    public function index(){
        $totalReg = Organizacao::count(); 
        $totalUser = User::count();

        return view("Tenants/home",compact('totalReg','totalUser'));
    }

    public function editarUsuario($id){
        $ususario = User::where('id',$id); //recupera o primeiro id

        return view ('Tenants/configuracao_userAdmin',compact($ususario));
    }

    public function alterarUsuario($id , Request $request){
        $ususario = User::findOrFail($id);
        $dataForm = $request->all();

        if($dataForm['password']==null){
            $dataForm['password'] = $ususario->password;
        }else{
            $dataForm['password']= Hash::make($dataForm['password']);
        }

        //dd($dataForm);

        $ususario->update($dataForm);

        return redirect()
                    ->route('usuario.editar',$ususario->id)
                    ->with('success', 'Configurações e usuário alterado com sucesso!');
    }



}
