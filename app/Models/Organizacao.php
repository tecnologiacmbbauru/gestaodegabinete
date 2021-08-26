<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organizacao extends Model
{
    protected $table = 'organizacoes';
    protected $fillable = ['name','domain',
    'image','bd_database','bd_hostname','bd_port','bd_username','bd_password','created_at','update_at'
    ];
}
