<?php

namespace App\Http\Controllers;

use App\Models\pessoa;
use App\Models\agentePolitico;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;

class EtiquetaController extends Controller
{
    public function __construct(){  //contrutor
        $this->middleware('auth');  //valida se o usuario esta logado
    }

    public function index()
    {
        return view('form_relat_etiqueta');
    }

    public function pesquisaAniversario(Request $request){
        $pesquisa = true; //variavel para controlar o if que mostra a tabela na view
        $dataform = $request->except('_token');

        $datainicial = now()->year."-".$dataform['mes_inicial']."-".$dataform['dia_inicial'];
        $datafinal = now()->year."-".$dataform['mes_final']."-".$dataform['dia_final'];

        //chama função birthdayBetween, passando como parâmetros DATA INICIAL e DATA FINAL
        //essa função não considera o ANO, então, passamos o ano atual
        $aniversariantes = pessoa::birthdayBetween(
                                $datainicial, 
                                $datafinal
                                )->where('ind_status','A')                                       //pesquisa as pessoas que não estão excluidas(ativas)
                                // ->orderBy('dat_nascimento','asc')
                                 ->orderByRaw('nom_nome asc')                       //ordena pela data de aniversario
                                 ->paginate(50);       //10 resultados por pagina
                                           
        $aniversariantes->withPath(config('app.url')."/etiquetaAniversarioResultado");

        return view('form_relat_etiqueta',compact('aniversariantes','dataform','pesquisa'));
    }

    public function imprimeEtiqueta(Request $request){
        $dataform = $request->all();
        
        $remetende = null; //imprime sem remetende
        if(isset($dataform['op_re'])){ //caso tenha marcado para imprimir com remetende
            $remetende = $dataform['op_re'];
        }

        $pularLinha = $dataform['pular'];


        //Caso venha do form relatorio de aniversariante a variavel chama aniversariante, casso venha de pessoa chama pessoa
        if(isset($dataform['pessoa'])){
            $aniversariantes = pessoa::whereIn('cod_pessoa',$dataform['pessoa'])->get();
        }else{
            //implode(",",$dataform['aniversariante']); --- trasnforma os código das pessoas selecionas em uma string separada por ","
            //$aniversariantes = pessoa::select('SELECT * FROM gab_pessoa WHERE cod_pessoa IN('.implode(',',$dataform['aniversariante']).')')->get();
            //Atualizado:: Usando o mesmo código acima (WHERE IN mas sem precisar usar o implode)
            $aniversariantes = pessoa::whereIn('cod_pessoa',$dataform['aniversariante'])->get(); 
        }
        //dd($aniversariantes);
        $agentePolitico = agentePolitico::first();

        if($dataform['tip_et']==14){
            $pdf = PDF::loadView('pdf/aniversariantesEtiqueta14',compact('agentePolitico','aniversariantes','remetende','pularLinha'), [], [
                'format' => 'Letter'
              ]);
            return $pdf->stream('aniversariantes.pdf');
        }else if($dataform['tip_et']==20){
            $pdf = PDF::loadView('pdf/aniversariantesEtiqueta20',compact('agentePolitico','aniversariantes','remetende','pularLinha'), [], [
                'format' => 'Letter'
              ]);
            return $pdf->stream('aniversariantes.pdf');
        }elseif($dataform['tip_et']==30){
            $pdf = PDF::loadView('pdf/aniversariantesEtiqueta30',compact('agentePolitico','aniversariantes','remetende','pularLinha'));
            
            return $pdf->stream('aniversariantes.pdf');
        }else{
            return ("Erro desconhecido");
        }
        
    }
}
