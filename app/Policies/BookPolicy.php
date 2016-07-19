<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;
use App\Book;

class BookPolicy
{
    use HandlesAuthorization;

    public function show(User $user, Book $book)
    {

    if (!$book->lends()->where('book_id', '=', $book->id)->whereNull('date_getin_fact')->first())

        return $user->role == 'admin';

    else return $user->id === $book->lends()->whereNull('date_getin_fact')->first()->user()->first()->id
             or $user->role == 'admin';

    }
    
}