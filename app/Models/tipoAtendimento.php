<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tipoAtendimento extends Model
{
    protected $primaryKey = 'cod_tipo';
    protected $table = 'gab_tipo_atendimento';
    protected $fillable = ['nom_tipo','ind_tipo'];
    protected $guarded = ['cod_tipo'];

    //resposta chamada de chave estrangeira (has one 1-1)
    public function atendimento()
    {
        //$this->hasOne(relacao, chave estrangeira, primary key);
        return $this->hasOne('App\Models\atendimento', 'GAB_TIPO_ATENDIMENTO_cod_tipo', 'cod_tipo');
    }
}