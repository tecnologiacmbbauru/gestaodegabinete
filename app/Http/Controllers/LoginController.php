<?php

namespace App\Http\Controllers;

use App\Tenant\ManagerTenant;
use App\Models\Organizacao;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function authenticate(Request $request, ManagerTenant $manager)
    {
        $credentials = $request->only('user_name', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            if(Auth::user()->domain=="system"){
                return redirect()->route('tenant.index');
            }else{
                return redirect()->route('index');
            }
        }else{
            $user = User::where('user_name',$credentials['user_name'])->first();
            if($user===null){
                return redirect()->route('login')->withErrors([
                    'user_name' => 'Usuário não encontrado.',
                ]);
            }else{
                return redirect()->route('login')->withErrors([
                    'password' => 'A senha não confere com o usuário cadastrado.',
                ]);
            }
        }
    }

    public function getOrganizacao($host){
        return Organizacao::where('domain',$host)->first();
    }
}
