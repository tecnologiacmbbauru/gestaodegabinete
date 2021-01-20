<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class unidadeDocumento extends Model
{
    protected $primaryKey = 'cod_uni_doc';
    protected $table = 'gab_unidade_documento';
    protected $fillable = ['nom_uni_doc','ind_uni_doc'];
    protected $guarded = ['cod_uni_doc'];

    public function documento()
    {
        return $this->hasOne('App\Models\documento','GAB_UNIDADE_DOCUMENTO_cod_uni_doc', 'cod_uni_doc');
    }

}
