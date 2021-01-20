<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class chaveAgenda extends Model
{
    protected $table = 'gab_calendar_key';
    protected $primaryKey = 'api_key'; //precisa definir a chave primaria caso ao contrario laravel trata "id" por padrão
    public $incrementing = false; // para não autoincrimentar a chave primaria
    protected $fillable = ['api_key','calendar_id'];
}
