<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Http\Request;
use App\{Book, User};

class BookPolicy
{
    use HandlesAuthorization;

    public function show(User $user, Book $book)
    {
        if (!$book->isCharged())
            return $user->isAdmin();
        else
            return $book->isChargedByUser($user) or $user->isAdmin();
    }

    public function edit(User $user, Book $book)
    { 
        return ($user->isAdmin());
    }

    public function update(User $user, Book $book)
    {;
        return ($user->isAdmin());
    }

    public function create(User $user, Book $book)
    {
        return ($user->isAdmin());
    }

    public function store(User $user, Book $book)
    {
        return ($user->isAdmin());
    }
    
    public function destroy(User $user, Book $book)
    {
       return ($user->isAdmin());
    }


}