<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;
class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    /*
    public static function bookCount()
    {
        $users = DB::table('users')
            ->leftJoin('lends', function ($join){
                $join->on('users.id', '=', 'lends.user_id')->whereNull('lends.date_getin_fact');
            })
            ->select(DB::raw('users.*, count(lends.book_id) as book_count'))
            ->groupBy('users.id');
        /*
        select users.*, count(l.book_id) from users
        LEFT JOIN (
        SELECT lends.user_id, lends.book_id
        FROM lends
        WHERE lends.date_getin_fact IS NULL
        ) AS l ON users.id = l.user_id
        group by users.id
        
        return  $users;
    }
    */
}
