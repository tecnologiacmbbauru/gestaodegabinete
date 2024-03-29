<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\CarbonPeriod;
use Carbon\Carbon;

class Pessoa extends Model
{
    protected $connection = 'tenant';
    protected $primaryKey = 'cod_pessoa';
    protected $table = 'gab_pessoa';
    protected $fillable = ['ind_pessoa','image','nom_nome',
    'nom_apelido','nom_ocupacao',
    'cod_cpf_cnpj','cod_ie','cod_rg','ind_sexo',
    'num_cep','nom_endereco','nom_numero','nom_estado',
    'nom_cidade','num_ddd_tel','num_tel','num_ddd_cel',
    'num_cel','nom_email','nom_rede_social','gab_pessoacol',
    'img_foto','ind_status','txt_obs','dat_log','nom_usuario_log',
    'nom_operacao_log','nom_re','nom_bairro','nom_complemento','dat_nascimento'
    ];
   // protected $dates = [

   // ];
    //protected $guarded = ['cod_pessoa'];

    public function atendimento()
    {
        return $this->hasOne('App\Models\atendimento', 'GAB_PESSOA_cod_pessoa', 'cod_pessoa');
    }

    public function pesquisaLimitada(array $data) {
        return $this->where(function($query) use($data) {
            $query->where('ind_status',"A");//apenas as que o status seja igual a ATIVO. Caso ao contrario ela esta excluida

            if(isset($data['nom_nome'])) { //isset verifica se aquela variavel existe
                $query->where('nom_nome','LIKE',"%{$data['nom_nome']}%"); //Compara se tem o digitado pelo dataform em algum lugar do registro
                                                                         // Exemoplo digitou 'ca' no formulario e o registro tem "caio" então é retornado| Case insentive
            }
            if(isset($data['nom_apelido'])) {
                $query->where('nom_apelido',$data['nom_apelido']);// Compara se o nom_apelido do registro é exatamente igual o enviado pelo dataform
                                                                  // Equivale a  $query->where('nom_apelido','=',$data['nom_apelido']); mas o '=' é omitido
            }
            if(isset($data['nom_ocupacao'])) {
                $query->where('nom_ocupacao',$data['nom_ocupacao']);
            }
            if(isset($data['dat_nascimento'])) {
                $query->where('dat_nascimento',$data['dat_nascimento']);
            }
            if(isset($data['cod_cpf_cnpj'])) {
                $query->where('cod_cpf_cnpj',$data['cod_cpf_cnpj']);
            }
            if(isset($data['cod_ie'])) {
                $query->where('cod_ie',$data['cod_ie']);
            }
            if(isset($data['cod_rg'])) {
                $query->where('cod_rg',$data['cod_rg']);
            }
            if(isset($data['ind_sexo'])) {
                $query->where('ind_sexo',$data['ind_sexo']);
            }
            if(isset($data['num_cep'])) {
                $query->where('num_cep',$data['num_cep']);
            }
            if(isset($data['nom_endereco'])) {
                $query->where('nom_endereco','LIKE',"%{$data['nom_endereco']}%");
            }
            if(isset($data['nom_numero'])) {
                $query->where('nom_numero',$data['nom_numero']);
            }
            if(isset($data['nom_estado'])) {
                $query->where('nom_estado',$data['nom_estado']);
            }
            if(isset($data['nom_cidade'])) {
                $query->where('nom_cidade',$data['nom_cidade']);
            }
            if(isset($data['num_ddd_tel'])) {
                $query->where('num_ddd_tel',$data['num_ddd_tel']);
            }
            if(isset($data['num_tel'])) {
                $query->where('num_tel',$data['num_tel']);
            }
            if(isset($data['num_ddd_cel'])) {
                $query->where('num_ddd_cel',$data['num_ddd_cel']);
            }
            if(isset($data['num_cel'])) {
                $query->where('num_cel',$data['num_cel']);
            }
            if(isset($data['nom_email'])) {
                $query->where('nom_email',$data['nom_email']);
            }
            if(isset($data['nom_rede_social'])) {
                $query->where('nom_rede_social',$data['nom_rede_social']);
            }
            if(isset($data['nom_re'])) {
                $query->where('nom_re',$data['nom_re']);
            }
            if(isset($data['nom_bairro'])) {
                $query->where('nom_bairro',$data['nom_bairro']);
            }
        })->orderby('nom_nome','asc')->limit(500)->get(); //retorna 20 registro por pagina me modo crescente de acordo com o campo nome
    }                                                               //onEachSide faz mostrar apenas 1 numero do lado do que esta selecionado

    public function pesquisa(array $data) {
        return $this->where(function($query) use($data) {
            $query->where('ind_status',"A");//apenas as que o status seja igual a ATIVO. Caso ao contrario ela esta excluida

            if(isset($data['nom_nome'])) { //isset verifica se aquela variavel existe
                $query->where('nom_nome','LIKE',"%{$data['nom_nome']}%"); //Compara se tem o digitado pelo dataform em algum lugar do registro
                                                                          // Exemoplo digitou 'ca' no formulario e o registro tem "caio" então é retornado| Case insentive
            }
            if(isset($data['nom_apelido'])) {
                $query->where('nom_apelido',$data['nom_apelido']);// Compara se o nom_apelido do registro é exatamente igual o enviado pelo dataform
                                                                  // Equivale a  $query->where('nom_apelido','=',$data['nom_apelido']); mas o '=' é omitido
            }
            if(isset($data['nom_ocupacao'])) {
                $query->where('nom_ocupacao',$data['nom_ocupacao']);
            }
            if(isset($data['dat_nascimento'])) {
                $query->where('dat_nascimento',$data['dat_nascimento']);
            }
            if(isset($data['cod_cpf_cnpj'])) {
                $query->where('cod_cpf_cnpj',$data['cod_cpf_cnpj']);
            }
            if(isset($data['cod_ie'])) {
                $query->where('cod_ie',$data['cod_ie']);
            }
            if(isset($data['cod_rg'])) {
                $query->where('cod_rg',$data['cod_rg']);
            }
            if(isset($data['ind_sexo'])) {
                $query->where('ind_sexo',$data['ind_sexo']);
            }
            if(isset($data['num_cep'])) {
                $query->where('num_cep',$data['num_cep']);
            }
            if(isset($data['nom_endereco'])) {
                $query->where('nom_endereco','LIKE',"%{$data['nom_endereco']}%");
            }
            if(isset($data['nom_numero'])) {
                $query->where('nom_numero',$data['nom_numero']);
            }
            if(isset($data['nom_estado'])) {
                $query->where('nom_estado',$data['nom_estado']);
            }
            if(isset($data['nom_cidade'])) {
                $query->where('nom_cidade',$data['nom_cidade']);
            }
            if(isset($data['num_ddd_tel'])) {
                $query->where('num_ddd_tel',$data['num_ddd_tel']);
            }
            if(isset($data['num_tel'])) {
                $query->where('num_tel',$data['num_tel']);
            }
            if(isset($data['num_ddd_cel'])) {
                $query->where('num_ddd_cel',$data['num_ddd_cel']);
            }
            if(isset($data['num_cel'])) {
                $query->where('num_cel',$data['num_cel']);
            }
            if(isset($data['nom_email'])) {
                $query->where('nom_email',$data['nom_email']);
            }
            if(isset($data['nom_rede_social'])) {
                $query->where('nom_rede_social',$data['nom_rede_social']);
            }
            if(isset($data['nom_re'])) {
                $query->where('nom_re',$data['nom_re']);
            }
            if(isset($data['nom_bairro'])) {
                $query->where('nom_bairro',$data['nom_bairro']);
            }
        })->orderby('nom_nome','asc')->get();//Retorna todos os resultados encontrados por ordem crescente de acordo com o nome
    }

    //FUNÇÃO QUE RETORNA AS PESSOAS COM DATA DE ANIVERSÁRIO DENTRO DO PERÍODO PASSADO COMO PARAMETRO
    public function scopeBirthdayBetween($query, $dateBegin, $dateEnd)
    {
        $period = CarbonPeriod::create($dateBegin, $dateEnd);

        foreach ($period as $key => $date) {
            $queryFn = function($query) use ($date) {
                $query->whereMonth("dat_nascimento", '=', $date->format('m'))->whereDay("dat_nascimento", '=', $date->format('d'));
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

