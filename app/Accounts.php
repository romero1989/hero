<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Accounts extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['account', 'email', 'senha', 'cargo', 'data', 'alteracao', 'Prg Secreta', 'Res Secreta'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['senha', 'remember_token'];
    //protected $primaryKey = 'id';
    //protected $table = "accounts";
}
