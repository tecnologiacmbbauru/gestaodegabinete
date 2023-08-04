<?php

namespace App\Models;

use App\Models\CargoPolitico;

use Illuminate\Database\Eloquent\Model;

class AgentePolitico extends Model
{
    protected $connection = 'tenant';
    public $primaryKey = 'id';
    protected $table = 'gab_vereador';
    protected $fillable = ['nom_vereador', 'nom_endereco', 'nom_numero', 'nom_complemento',
        'nom_cidade', 'nom_estado', 'num_cep', 'img_foto', 'tip_foto', 'tam_foto',
        'nom_orgao', 'GAB_CARGO_POLITICO_cod_car_pol'];
    protected $guarded = ['id'];

    public function cargoPolitico()
    {
        return $this->belongsTo('App\Models\CargoPolitico', 'GAB_CARGO_POLITICO_cod_car_pol', 'cod_car_pol');
    }
}
