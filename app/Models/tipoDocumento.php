<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tipoDocumento extends Model
{
    protected $connection = 'tenant';	
    protected $primaryKey = 'cod_tip_doc'; //definir qual a chave primaria
    protected $table = 'gab_tipo_documento'; //definir o nome da tabela
    protected $fillable = ['nom_tip_doc','ind_tip_doc']; //definir qual pode ser alterado
    protected $guarded = ['cod_tip_doc']; //definir qual não pode ser alterado pelo usuario

    public function documento()
    {
        return $this->hasOne('App\Models\documento','GAB_TIPO_DOCUMENTO_cod_tip_doc', 'cod_tip_doc');
    }
}
