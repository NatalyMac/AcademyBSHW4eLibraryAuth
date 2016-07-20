<?php

namespace App\Repositories;

use App\User;
use DB;


class UserRepository
{
    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Builder;
     */
    public function forUser(User $user)
    {

        if ($user->isReader())
            $users = DB::table('users')
                ->leftJoin('lends', function ($join){
                    $join->on('users.id', '=', 'lends.user_id')->whereNull('lends.date_getin_fact');
                })
                ->select(DB::raw('users.*, count(lends.book_id) as book_count'))
                ->where('users.id','=', $user->id);

        if ($user->isAdmin())
            $users = DB::table('users')
                ->leftJoin('lends', function ($join){
                    $join->on('users.id', '=', 'lends.user_id')->whereNull('lends.date_getin_fact');
                })
                ->select(DB::raw('users.*, count(lends.book_id) as book_count'))
                ->groupBy('users.id');

        return $users;


    }

}
