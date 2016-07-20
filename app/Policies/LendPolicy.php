<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Http\Request;
use App\{User, Lend};

class LendPolicy
{
    use HandlesAuthorization;
    
    public function update(User $user, Lend $lend)
    {
        return ($user->isAdmin());
    }

    public function create(User $user, Lend $lend)
    {
        return ($user->isAdmin());
    }

    public function store(User $user, Lend $lend)
    {
        return ($user->isAdmin());
    }



}