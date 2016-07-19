<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Http\Request;
use App\User;


class UserPolicy
{
    use HandlesAuthorization;
    
}