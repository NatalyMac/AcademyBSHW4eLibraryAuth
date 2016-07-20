<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function lends()
    {
        return $this->hasMany('App\Lend');
    }

    public function isAdmin()
    {
        return $this->role =='admin';
    }

    public function isReader()
    {
        return $this->role =='reader';
    }

    public function isOwner($id)
    {
        return \Auth::id() == $id->id;
    }

    public static function getReaders()
    {
        return User::where('role', '=', 'reader')->select('id', 'firstname', 'lastname')->get();
    }

}

