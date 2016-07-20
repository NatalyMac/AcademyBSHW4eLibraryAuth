<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;


class Book extends Model
{
    public function lends()
    {
        return $this->hasMany('App\Lend');
    }

    public function isCharged()
    {
        return $this->lends()->whereNull('date_getin_fact')->first();
    }

    public function isChargedByUser($user)
    {
        return $user->id === $this->lends()->whereNull('date_getin_fact')->first()->user()->first()->id;
    }

    public function getBookHolder()
    {
        return $this->lends()->whereNull('date_getin_fact')->first()->user()->first();
    }
    
}
