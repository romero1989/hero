<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'role_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function role() {
        return $this->belongsTo('App\Role');
    }

    /* public function isAdmin() {
        if ($this->role->nome == 'Admin') {
            return true;
        }
    }

    public function isUsuario() {
        if ($this->role->nome == 'Usuario') {
            return true;
        }
    }
*/
    public function isAdmin() {
        if ($this->role->nome == 'Admin') { // se diferente de 1
            return true;
        }
    }

    public function isUsuario() {
        if ($this->role->nome == 'Usuario') { //cargo de usuario igual a 1
            return true;
        }
    }


}
