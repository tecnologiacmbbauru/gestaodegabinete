<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SituacaoDoc extends Model
{
    protected $connection = 'tenant';
    protected $primaryKey = 'cod_status';
    protected $table = 'gab_status_documento';
    protected $fillable = ['nom_status','ind_status'];
    protected $guarded = ['cod_status'];

    public function documento()
    {
        return $this->hasOne('App\Models\documento', 'GAB_STATUS_DOCUMENTO_cod_status', 'cod_status');
    }
}
