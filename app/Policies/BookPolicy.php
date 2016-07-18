<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;
use App\Book;

class BookPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given user can delete the given task.
     *
     * @param  User  $user
     * @param  Book  $book
     * @return bool
     */
    public function show(User $user, Book $book)
    {
        return $user->id === $book->lends()->whereNull('date_getin_fact')->first()->user()->first()->id;
      
    }

    public function create(User $user)
    {
        return $user->role='admin';
    }
}