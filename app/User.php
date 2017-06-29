<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'verifyToken',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles() {
        return $this->belongsToMany('App\Roles');
    }

    public function thread() {
        return $this->hasMany('App\Thread');
    }


    public function message() {
        return $this->hasMany('App\Message');
    }

    /**
     * @param $roleName
     * @return bool
     *
     * Check user role.
     *
     */
    public function checkRole($roleName) {

        foreach ($this->roles()->get() as $role) {

            if ($role->name == $roleName) {
                return true;
            }

        }

        return false;

    }


}
