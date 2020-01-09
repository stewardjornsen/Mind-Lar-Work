<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $with = ['person'];
    public function events()
    {
        return $this->morphToMany('App\Event', 'eventable');
    }
    public function person()
    {
        return $this->belongsTo('App\Person');
    }
}
