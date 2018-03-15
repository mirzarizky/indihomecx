<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $dates = [
        'created_at', 'updated_at'
    ];

    protected $fillable = [
        'nik', 'name', 'email', 'noHp', 'password', 'defaulPassword', 'avatar_id', 'role_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role() {
        return $this->hasOne('App\Role', 'id', 'role_id');
    }

    public function avatar() {
        return $this->hasOne('App\Avatar', 'id', 'avatar_id');
    }
}
