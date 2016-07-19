<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        'App\Book' => 'App\Policies\BookPolicy',
        'App\User' => 'App\Policies\UserPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->define('create', function ($user){
            return $user->role == 'admin';});

        $gate->define('update', function ($user){
            return $user->role == 'admin';});

        $gate->define('edit', function ($user){
            return $user->role == 'admin';});

        $gate->define('store', function ($user){
            return $user->role == 'admin';});

        $gate->define('destroy', function ($user){
            return $user->role == 'admin';});

        //TODO id user == id Auth user for users/show
        //$gate->define('show', function ($user){
        //    return  $user->role == 'admin';});


    }
}
