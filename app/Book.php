<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Lend;
use App\User;

class Book extends Model
{
    public function lends()
    {
        return $this->hasMany('App\Lend');
    }

    /*
    public static function bookHolder1()
    {
        $books = DB::table('books')
            ->leftJoin('lends', function ($join){
                $join->on('books.id', '=', 'lends.book_id')->whereNull('lends.date_getin_fact');
             })
            ->leftJoin('users', 'users.id', '=', 'lends.user_id')
            ->select('books.*', 'users.firstname', 'users.lastname');
        /*
        SELECT books. * , users.firstname
        FROM books
        LEFT JOIN (
        SELECT lends.user_id, lends.book_id
        FROM lends
        WHERE lends.date_getin_fact IS NULL
        ) AS l ON books.id = l.book_id
        LEFT JOIN users ON users.id = l.user_id
        

        return  $books;
    }
    */
}
