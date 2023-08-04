<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\CarbonPeriod;
use Carbon\Carbon;


class Atendimento extends Model
{
    protected $connection = 'tenant';
    protected $primaryKey = 'cod_atendimento';
    protected $table = 'gab_atendimento';
    protected $fillable = ['dat_atendimento','txt_detalhes','nom_usuario_log',
    'nom_operacao_log','ind_status','lembrete','dat_lembrete','dat_atendimento',
    'GAB_PESSOA_cod_pessoa','GAB_TIPO_ATENDIMENTO_cod_tipo','GAB_STATUS_ATENDIMENTO_cod_status'];
    protected $guarded = ['cod_atendimento'];


    //chamadas das chaves estrangeiras
    public function tipoAtendimento(){
        return $this->belongsTo('App\Models\TipoAtendimento', 'GAB_TIPO_ATENDIMENTO_cod_tipo', 'cod_tipo');
    }
    public function statusAtendimento(){
        return $this->belongsTo('App\Models\StatusAtendimento', 'GAB_STATUS_ATENDIMENTO_cod_status', 'cod_status');
    }
    public function pessoa(){
        return $this->belongsTo('App\Models\Pessoa', 'GAB_PESSOA_cod_pessoa', 'cod_pessoa');
    }
    public function documento()
    {
        return $this->hasOne('App\Models\Documento', 'GAB_ATENDIMENTO_cod_atendimento', 'cod_atendimento');
    }

    public function pesquisaLimitada(array $data) {
        return $this->where(function($query) use($data) {
            $query->where('ind_status',"A");//apenas as que o status seja igual a ATIVO. Caso ao contrario ela esta excluida
            if(isset($data['GAB_PESSOA_cod_pessoa'])) {
                $query->where('GAB_PESSOA_cod_pessoa',$data['GAB_PESSOA_cod_pessoa']);
            }
            if(isset($data['GAB_STATUS_ATENDIMENTO_cod_status'])) {
                $query->where('GAB_STATUS_ATENDIMENTO_cod_status',$data['GAB_STATUS_ATENDIMENTO_cod_status']);
            }
            if(isset($data['GAB_TIPO_ATENDIMENTO_cod_tipo'])) {
                $query->where('GAB_TIPO_ATENDIMENTO_cod_tipo',$data['GAB_TIPO_ATENDIMENTO_cod_tipo']);
            }
            if(isset($data['dat_atendimento'])){ //se existir data de atendimento (form de pesquisa de atendimento)
                $query->where('dat_atendimento',$data['dat_atendimento']);
            }
            if(isset($data['dat_ini'])) { //se existir data inicial (form pesquisa de relatório de atendimento)
                $query->where('dat_atendimento','>=',$data['dat_ini']);
            }
            if(isset($data['dat_fim'])) {
                $query->where('dat_atendimento','<=',$data['dat_fim']);
            }
        })->orderby('dat_atendimento','desc')->limit(500)->get();
    }

    public function pesquisa(array $data) {
        return $this->where(function($query) use($data) {
            $query->where('ind_status',"A");//apenas as que o status seja igual a ATIVO. Caso ao contrario ela esta excluida
            if(isset($data['GAB_PESSOA_cod_pessoa'])) {
                $query->where('GAB_PESSOA_cod_pessoa',$data['GAB_PESSOA_cod_pessoa']);
            }
            if(isset($data['GAB_STATUS_ATENDIMENTO_cod_status'])) {
                $query->where('GAB_STATUS_ATENDIMENTO_cod_status',$data['GAB_STATUS_ATENDIMENTO_cod_status']);
            }
            if(isset($data['GAB_TIPO_ATENDIMENTO_cod_tipo'])) {
                $query->where('GAB_TIPO_ATENDIMENTO_cod_tipo',$data['GAB_TIPO_ATENDIMENTO_cod_tipo']);
            }
            if(isset($data['dat_ini'])) {
                $query->where('dat_atendimento','>=',$data['dat_ini']);
            }
            if(isset($data['dat_fim'])) {
                $query->where('dat_atendimento','<=',$data['dat_fim']);
            }
        })->orderby('dat_atendimento','desc')->get();
    }

    public function pesquisa10limit(array $data) {
        return $this->where(function($query) use($data) {
            $query->where('ind_status',"A");//apenas as que o status seja igual a ATIVO. Caso ao contrario ela esta excluida
            if(isset($data['GAB_PESSOA_cod_pessoa'])) {
                $query->where('GAB_PESSOA_cod_pessoa',$data['GAB_PESSOA_cod_pessoa']);
            }
            if(isset($data['GAB_STATUS_ATENDIMENTO_cod_status'])) {
                $query->where('GAB_STATUS_ATENDIMENTO_cod_status',$data['GAB_STATUS_ATENDIMENTO_cod_status']);
            }
            if(isset($data['GAB_TIPO_ATENDIMENTO_cod_tipo'])) {
                $query->where('GAB_TIPO_ATENDIMENTO_cod_tipo',$data['GAB_TIPO_ATENDIMENTO_cod_tipo']);
            }
            if(isset($data['dat_ini'])) {
                $query->where('dat_atendimento','>=',$data['dat_ini']);
            }
            if(isset($data['dat_fim'])) {
                $query->where('dat_atendimento','<=',$data['dat_fim']);
            }
        })->orderby('dat_atendimento','desc')->limit(10)->get();
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


