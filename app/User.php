<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPassword;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','user_name','email', 'password','ajuda_inicio','ajd_pessoa','ajd_documento','ajd_atendimento','corSystem'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function googleAccounts()
    {
        return $this->hasMany(GoogleAccount::class);
    }

    public function sendPasswordResetNotification($token)
        {
            //  use App\Notifications\ResetPassword;
            $this->notify(new ResetPassword($token));
        }
}
