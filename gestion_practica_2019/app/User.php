<?php

namespace SGPP;

use Illuminate\Notifications\Notifiable;
use SGPP\Notifications\ResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'type'
    ];
    protected $primaryKey = 'id_user';

    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function perfil(){
        return $this->belongsTo('App\User');
    }
    public function administrador(){
        return $this->hasOne('App\administrador');
    }
    public function supervisor(){
        return $this->hasOne('App\Supervisor');
    }
    public function alumno(){
        return $this->hasOne('App\Alumno');
    }
}
