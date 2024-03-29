<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\CarbonPeriod;

class Documento extends Model
{
    protected $connection = 'tenant';
    protected $primaryKey = 'cod_documento';
    protected $table = 'gab_documento';
    protected $fillable = ['nom_documento','dat_ano',
    'lnk_documento','link_resposta','txt_assunto','txt_resposta','nom_usuario_log','nom_operacao_log',
    'ind_status','GAB_UNIDADE_DOCUMENTO_cod_uni_doc','GAB_TIPO_DOCUMENTO_cod_tip_doc','lembrete','dat_lembrete',
    'GAB_STATUS_DOCUMENTO_cod_status','GAB_ATENDIMENTO_cod_atendimento','dat_documento','dat_resposta','path_doc','path_doc_resp'
    ];
    protected $dates = [

    ];
    protected $guarded = ['cod_documento'];

    //chamadas das chaves estrangeiras
    public function situacaoDoc(){
        return $this->belongsTo('App\Models\SituacaoDoc', 'GAB_STATUS_DOCUMENTO_cod_status', 'cod_status');
    }
    public function tipoDocumento(){
        return $this->belongsTo('App\Models\TipoDocumento', 'GAB_TIPO_DOCUMENTO_cod_tip_doc', 'cod_tip_doc');
    }
    public function unidadeDocumento(){
        return $this->belongsTo('App\Models\UnidadeDocumento', 'GAB_UNIDADE_DOCUMENTO_cod_uni_doc', 'cod_uni_doc');
    }
    public function antedimentoRelacionado(){
        return $this->belongsTo('App\Models\atendimento', 'GAB_ATENDIMENTO_cod_atendimento', 'cod_atendimento');
    }

    //PESQUISAS

    public function pesquisaLimitada(array $data) {
        return $this->where(function($query) use($data) {
            $query->where('ind_status',"A");//apenas as que o status seja igual a ATIVO. Caso ao contrario ela esta excluida
            if(isset($data['GAB_TIPO_DOCUMENTO_cod_tip_doc'])) {
                $query->where('GAB_TIPO_DOCUMENTO_cod_tip_doc',$data['GAB_TIPO_DOCUMENTO_cod_tip_doc']);
            }
            if(isset($data['nom_documento'])) {
                $query->where('nom_documento',$data['nom_documento']);
            }
            if(isset($data['dat_ano'])) {
                $query->where('dat_ano',$data['dat_ano']);
            }
            if(isset($data['dat_documento'])) {
                $query->where('dat_documento','=',$data['dat_documento']);
            }
            if(isset($data['dat_ini'])) {
                $query->where('dat_documento','>=',$data['dat_ini']);
            }
            if(isset($data['dat_fim'])) {
                $query->where('dat_documento','<=',$data['dat_fim']);
            }
            if(isset($data['GAB_STATUS_DOCUMENTO_cod_status'])) {
                $query->where('GAB_STATUS_DOCUMENTO_cod_status',$data['GAB_STATUS_DOCUMENTO_cod_status']);
            }
            if(isset($data['GAB_UNIDADE_DOCUMENTO_cod_uni_doc'])) {
                $query->where('GAB_UNIDADE_DOCUMENTO_cod_uni_doc',$data['GAB_UNIDADE_DOCUMENTO_cod_uni_doc']);
            }
            if(isset($data['resp_rel']) && !isset($data['dat_resposta'])) {//se existir uma resposta relacionada e não exister data de resposta
                $query->where('dat_resposta','!=',null); //retorna todas datas de resposta diferente de null
            }
            if(isset($data['dat_resposta'])) {
                $query->where('dat_resposta',$data['dat_resposta']);
            }
            if(isset($data['atend_rel']) && !isset($data['GAB_ATENDIMENTO_cod_atendimento'])){
                $query->where('GAB_ATENDIMENTO_cod_atendimento','!=',null);
            }
            if(isset($data['GAB_ATENDIMENTO_cod_atendimento'])) {
                $query->where('GAB_ATENDIMENTO_cod_atendimento',$data['GAB_ATENDIMENTO_cod_atendimento']);
            }
        })->orderby('dat_documento','desc')->limit(500)->get();
    }


    public function pesquisa(array $data) {
        return $this->where(function($query) use($data) {
            $query->where('ind_status',"A");//apenas as que o status seja igual a ATIVO. Caso ao contrario ela esta excluida
            if(isset($data['GAB_TIPO_DOCUMENTO_cod_tip_doc'])) {
                $query->where('GAB_TIPO_DOCUMENTO_cod_tip_doc',$data['GAB_TIPO_DOCUMENTO_cod_tip_doc']);
            }
            if(isset($data['nom_documento'])) {
                $query->where('nom_documento',$data['nom_documento']);
            }
            if(isset($data['dat_ano'])) {
                $query->where('dat_ano',$data['dat_ano']);
            }
            if(isset($data['dat_ini'])) {
                $query->where('dat_documento','>=',$data['dat_ini']);
            }
            if(isset($data['dat_fim'])) {
                $query->where('dat_documento','<=',$data['dat_fim']);
            }
            if(isset($data['GAB_STATUS_DOCUMENTO_cod_status'])) {
                $query->where('GAB_STATUS_DOCUMENTO_cod_status',$data['GAB_STATUS_DOCUMENTO_cod_status']);
            }
            if(isset($data['GAB_UNIDADE_DOCUMENTO_cod_uni_doc'])) {
                $query->where('GAB_UNIDADE_DOCUMENTO_cod_uni_doc',$data['GAB_UNIDADE_DOCUMENTO_cod_uni_doc']);
            }
            if(isset($data['resp_rel']) && !isset($data['dat_resposta'])) {//se existir uma resposta relacionada e não exister data de resposta
                $query->where('dat_resposta','!=',null); //retorna todas datas de resposta diferente de null
            }
            if(isset($data['dat_resposta'])) {
                $query->where('dat_resposta',$data['dat_resposta']);
            }
            if(isset($data['atend_rel']) && !isset($data['GAB_ATENDIMENTO_cod_atendimento'])){
                $query->where('GAB_ATENDIMENTO_cod_atendimento','!=',null);
            }
            if(isset($data['GAB_ATENDIMENTO_cod_atendimento'])) {
                $query->where('GAB_ATENDIMENTO_cod_atendimento',$data['GAB_ATENDIMENTO_cod_atendimento']);
            }
        })->orderby('dat_documento','desc')->get();
    }

    //FUNÇÃO QUE RETORNA AS PESSOAS COM DATA DE ANIVERSÁRIO DENTRO DO PERÍODO PASSADO COMO PARAMETRO
    public function scopeBirthdayBetween($query, $dateBegin, $dateEnd)
    {
        $period = CarbonPeriod::create($dateBegin, $dateEnd);

        foreach ($period as $key => $date) {
            $queryFn = function($query) use ($date) {
                $query->whereMonth("dat_lembrete", '=', $date->format('m'))->whereDay("dat_lembrete", '=', $date->format('d'))->whereYear("dat_lembrete", '=', $date->format('Y'));
            };

            if($key === 0) {
                $queryFn($query);
            } else {
                $query->orWhere(function($q) use ($queryFn) {
                    $queryFn($q);
                });
            }
        }

        return $query;
    }
}

