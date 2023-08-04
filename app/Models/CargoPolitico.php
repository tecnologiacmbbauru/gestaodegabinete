<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CargoPolitico extends Model
{
    protected $connection = 'tenant';
    protected $primaryKey = 'cod_car_pol';
    protected $table = 'gab_cargo_politico';
    protected $fillable = ['nom_car_pol','ind_car_pol'];
    protected $guarded = ['cod_car_pol'];


    public function agentePolitico()
    {
        return $this->hasOne('App\Models\agentePolitico', 'GAB_CARGO_POLITICO_cod_car_pol', 'cod_car_pol');
    }
}
