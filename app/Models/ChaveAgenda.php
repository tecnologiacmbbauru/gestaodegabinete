<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChaveAgenda extends Model
{
    protected $connection = 'tenant';
    protected $table = 'gab_calendar_key';
    protected $fillable = ['name','api_key','calendar_id'];
}
