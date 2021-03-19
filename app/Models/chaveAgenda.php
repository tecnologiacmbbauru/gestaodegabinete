<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class chaveAgenda extends Model
{
    protected $table = 'gab_calendar_key';
    protected $fillable = ['name','api_key','calendar_id'];
}
