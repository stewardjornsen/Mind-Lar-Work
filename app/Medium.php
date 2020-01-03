<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medium extends Model
{
    public function person(){
        return $this->belongsTo('App\Person');
    }
    public function events(){
        return $this->belongsToMany('App\Event');
    }
    public function post(){
        return $this->hasOne('App\Post');
    }
}
