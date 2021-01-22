<?php

namespace App\Models;
use App\Models\tipoAtendimento;
use App\Models\pessoa;
use Illuminate\Database\Eloquent\Model;

class atendimento extends Model
{
    protected $primaryKey = 'cod_atendimento';
    protected $table = 'gab_atendimento';
    protected $fillable = ['dat_atendimento','txt_detalhes','nom_usuario_log',
    'nom_operacao_log','ind_status',
    'GAB_PESSOA_cod_pessoa','GAB_TIPO_ATENDIMENTO_cod_tipo','GAB_STATUS_ATENDIMENTO_cod_status'];
    protected $guarded = ['cod_atendimento'];

    protected $dates = [
        'dat_atendimento',
    ];

    //chamadas das chaves estrangeiras
    public function tipoAtendimento(){
        return $this->belongsTo('App\Models\tipoAtendimento', 'GAB_TIPO_ATENDIMENTO_cod_tipo', 'cod_tipo');
    }
    public function statusAtendimento(){
        return $this->belongsTo('App\Models\statusAtendimento', 'GAB_STATUS_ATENDIMENTO_cod_status', 'cod_status');
    }
    public function pessoa(){
        return $this->belongsTo('App\Models\pessoa', 'GAB_PESSOA_cod_pessoa', 'cod_pessoa');
    }
    public function documento()
    {
        return $this->hasOne('App\Models\documento', 'GAB_ATENDIMENTO_cod_atendimento', 'cod_atendimento');
    }

    public function pesquisaPaginada(array $data) {
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
        })->orderby('dat_atendimento','desc')->paginate(15);
    }

    public function pesquisaPdf(array $data) {
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
            if(isset($data['dat_ini'])) {
                $query->where('dat_atendimento','>=',$data['dat_ini']);
            }
            if(isset($data['dat_fim'])) {
                $query->where('dat_atendimento','<=',$data['dat_fim']);
            }
        })->orderby('dat_atendimento','desc')->limit(10)->get();
    }
   

}


