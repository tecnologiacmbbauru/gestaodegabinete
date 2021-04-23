<?php

namespace App\Http\Controllers;

use App\Models\pessoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


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
        return view('form_pessoa',compact('alteracao'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $dataform = $request->all();
        //dd($dataform);
        if($dataform['ind_status'] == NULL){
            $dataform['ind_status'] == 'A';
        }
        
        if($request->hasFile('img_perfil') && $request->img_perfil->isValid()){
            $imagePath = $request->img_perfil->store(Auth::user()->domain.'/pessoa');
            $dataform['image']=$imagePath;
        }

        //foto enviada pela webcam
        if($dataform['foto_webcam']!=null){
            //dd($request->all());
            $imageName = Str::random(10).'.png';  
            $imagePath = Auth::user()->domain.'/pessoa'.'/'.$imageName;
            Storage::put(Auth::user()->domain.'/pessoa'.'/'.$imageName, base64_decode($request->foto_webcam));
            $dataform['image']=$imagePath;
        }


        $dataform['nom_usuario_log'] = auth()->user()->name;
        $dataform['nom_operacao_log'] = 'INSERT';
        //dd($dataform);
        
        try{
            $insert = $this->pessoaC->create($dataform);
            return redirect()
                        ->route('pessoa.index')
                        ->with('success', 'Pessoa cadastrada com sucesso!');
        } catch (\Exception $e) {
            return redirect()
                ->route('pessoa.index')
                ->with('error', 'A pessoa não pode ser cadastrada, algum campo foi preenchido de forma indevida.');
        }
    
    }

    public function pesquisaPessoa(Request $request,pessoa $pessoaModel){
        $alteracao = false;
        $mostraPesq=true;
        $dataform = $request->except('_token','ind_status');
        $pessoa = $pessoaModel->pesquisaLimitada($dataform);
        $pessoa = $pessoa->paginate(20)->onEachSide(1);
        $pessoa->withPath(config('app.url')."/pessoa/pesquisa");//Passar para a função de paginação a url principal (encontrada no .env) e continuar a rota "/pessoa/pesquisa"
    
        return view('form_pessoa',compact('alteracao','mostraPesq','dataform','pessoa'));
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
        $dataform = $request->all();
        $pessoaC = pessoa::findOrFail($id);

        if($request->hasFile('img_perfil') && $request->img_perfil->isValid()){
            Storage::delete($pessoaC->image); //deleta foto antiga da pessoa
            $imagePath = $request->img_perfil->store(Auth::user()->domain.'/pessoa');
            $dataform['image']=$imagePath;
        }

        //foto enviada pela webcam
        if($dataform['foto_webcam']!=null){
            //dd($request->all());
            $imageName = Str::random(15).'.png';  
            $imagePath = Auth::user()->domain.'/pessoa'.'/'.$imageName;
            Storage::put(Auth::user()->domain.'/pessoa'.'/'.$imageName, base64_decode($request->foto_webcam));
            $dataform['image']=$imagePath;
        }

        $dataform['nom_usuario_log'] = auth()->user()->name;
        $dataform['nom_operacao_log'] = "UPDATE";

        try{
            $pessoaC->update($dataform);
            return redirect()
                        ->route('pessoa.index')
                        ->with('success', 'Pessoa alterada com sucesso!');
        } catch (\Exception $e) {
            return redirect()
                ->route('pessoa.index')
                ->with('error', 'A pessoa não pode ser alterada.');
        }
    }


    public function destroy(Request $request)
    {
        $pessoaC = pessoa::findOrFail($request->id_exclusao);
        //$pessoaC = $pessoaC->delete(); //excluir de verdade
        $inativo = array('ind_status'=> 'I', 'nom_usuario_log' => auth()->user()->name,'nom_operacao_log'=>'DELETE' );

        $pessoaC->update($inativo);

        Storage::delete($pessoaC->image); //deleta foto da pessoa

        return redirect()
                    ->route('pessoa.index')
                    ->with('success', 'Pessoa excluída com sucesso!');

        // Redireciona de volta com uma mensagem de erro
        //return redirect()
         //           ->back()
         //           ->with('error', 'Erro ao excluir.');
    }

    /*public function tirarFoto(Request $request){
        /*$acao = $request['acao'];
        $img64 = $request['base_img'];
        //dd($img64);
        $result = [];
 
        $data = str_replace(" ","+",$img64);
        $name = md5(time().uniqid()); 
        $path = "snaps/{$name}.jpg";

        //data
	    $data = explode(',', $data);
        //dd($data);
        //Save data
        file_put_contents($path, base64_decode(trim($data[1])));
        
        //Print Data
        $result['img'] = $path;
        dd($result);
        //echo json_encode($result, JSON_PRETTY_PRINT);
        $acao = $request['acao'];
        $img64 = $request['img64'];

        try{
            //dd($img64);
            $result = [];

            $data = str_replace(" ","+",$img64);
            $name = md5(time().uniqid()); 
            $path = "foto_temporaria/{$name}.jpg";
    
            //data
            $data = explode(',', $data);
            //dd($data);
            
            //Save data
            file_put_contents($path, base64_decode(trim($data[1])));
            
            //Print Data
            $result['img'] = $path;
            $result['img_64'] = trim($data[1]);
            return response()->json($result);
        }catch(\Exception $e){
            return response()->json($e->getMessage());
        }

    }*/
}
