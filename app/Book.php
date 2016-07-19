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
    
}
