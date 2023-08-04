<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Organizacao;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class TenantUsuarioController extends Controller
{
    private $ususario;

    public function __construct(User $ususario){
        $this->middleware('auth');
        $this->ususario = $ususario;
    }

    public function cadastrarUsuario(Request $request){
        $data = $request->all();
        $id = $data['id'];

        try{
            User::create([
                'name'      => $data['name'],
                'user_name' => $data['user_name'],
                'email'     => $data['email'],
                'domain'    => $data['domain'],
                'corSystem' => 'blue-grey',
                'ajuda_inicio' => true,
                'ajd_pessoa' => true,
                'ajd_documento' => true,
                'ajd_atendimento' => true,
                'password'  => Hash::make($data['password']),
            ]);
            return redirect()
                ->route('organizacao.show',$id)
                ->with('success', 'Usuário cadastrado com sucesso.');
        } catch (\Exception $e){
            if($e->getCode()=='23000'){
                return redirect()
                    ->route('organizacao.show',$id)
                    ->with('error', 'Cadastro não realizado. Não pode existir nome de usuários duplicados no sistema');
            }else{
                return redirect()
                    ->route('organizacao.show',$id)
                    ->with('error', 'Cadastro de usuários não pode ser realizado.');
            }
        }
    }

    public function cadUsuariosPadrao($domain){
        User::create([
            'name' => $domain.'1',
            'domain' => $domain,
            'user_name' => $domain.'1',
            'password' => Hash::make($domain.'1'),
            'corSystem' => 'blue-grey',
            'ajuda_inicio' => '1',
            'ajd_pessoa' => '1',
            'ajd_documento' => '1',
            'ajd_atendimento' => '1',
        ]);
        User::create([
            'name' => $domain.'2',
            'domain' => $domain,
            'user_name' => $domain.'2',
            'password' => Hash::make($domain.'2'),
            'corSystem' => 'blue-grey',
            'ajuda_inicio' => '1',
            'ajd_pessoa' => '1',
            'ajd_documento' => '1',
            'ajd_atendimento' => '1',
        ]);
        User::create([
            'name' => $domain.'3',
            'domain' => $domain,
            'user_name' => $domain.'3',
            'password' => Hash::make($domain.'3'),
            'corSystem' => 'blue-grey',
            'ajuda_inicio' => '1',
            'ajd_pessoa' => '1',
            'ajd_documento' => '1',
            'ajd_atendimento' => '1',
        ]);
        $organizacao = Organizacao::where('domain',$domain)->get();
        $id = $organizacao[0]->id;

        return redirect()
            ->route('organizacao.show',$id)
            ->with('success', 'Cadastro de usuários realizado com sucesso.');
    }

    public function resetSenha(Request $request){
        $usuario = User::findOrFail($request->alter_id);

        $usuario->password = Hash::make($usuario->user_name);

        $usuario->save();

        $organizacao = Organizacao::where('domain',$usuario->domain)->get();

        if($organizacao!=null){
            $id = $organizacao[0]->id;
            return redirect()
                        ->route('organizacao.show',$id)
                        ->with('success', 'Senha do usuário resetada com sucesso!');
        }else{
            return redirect()
                ->route('organizacao.index')
                ->with('error', 'Falha desconhecida.');
        }
    }

    public function updateUsuario(){

    }

    public function excluirUsuario(Request $request){
        $usuario = User::findOrFail($request->user_id);
        try {
            $usuario->delete();

            $organizacao = Organizacao::where('domain',$usuario->domain)->get();


            if($organizacao!=null){
                $id = $organizacao[0]->id;
                return redirect()
                            ->route('organizacao.show',$id)
                            ->with('success', 'Usuário excluído com sucesso!');
            }else{
                return redirect()->route('organizacao.index')->with('success', 'Usuário excluído com sucesso!');
            }
        } catch (\Exception $e){
            return redirect()
                ->route('organizacao.index')
                ->with('error', 'Usuário não pode ser excluído.');
        }
    }

}
