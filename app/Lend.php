<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lend extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function book()
    {
        return $this->belongsTo('App\Book');
    }

    public static function getLend($book_id, $user_id)
    {
        return Lend::whereNull('date_getin_fact')
            ->where('book_id', '=', $book_id)
            ->where('user_id', '=', $user_id)->first();
    }

}
