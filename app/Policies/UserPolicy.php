<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Http\Request;
use App\User;


class UserPolicy
{
    use HandlesAuthorization;

    public function show(User $user, User $id)
    {
        return ($user->isAdmin() or $user->isOwner($id));
    }

    public function edit(User $user, User $id)
    {
        return ($user->isAdmin() or $user->isOwner($id));
    }
    
    public function update(User $user, User $id)
    {
        return ($user->isAdmin() or $user->isOwner($id));
    }
    
    public function create(User $user)
    {
        return ($user->isAdmin());
    }
    
    public function store(User $user)
    {
        return ($user->isAdmin());
    }
    
    public function destroy(User $user)
    {
        return ($user->isAdmin());
    }

}