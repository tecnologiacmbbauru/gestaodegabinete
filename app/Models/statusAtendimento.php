<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class statusAtendimento extends Model
{
    protected $primaryKey = 'cod_status';
    protected $table = 'gab_status_atendimento';
    protected $fillable = ['nom_status','ind_status'];
    protected $guarded = ['cod_status'];

    public function atendimento()
    {
        return $this->hasOne('App\Models\atendimento', 'GAB_TIPO_ATENDIMENTO_cod_tipo', 'cod_status');
    }
}
