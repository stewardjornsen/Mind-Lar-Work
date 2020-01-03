<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $with = ['person'];

    //POLYMORPHIC RELATIONSHIPS

    public function events()
    {
        return $this->morphToMany('App\Event', 'eventable');
    }
    public function person()
    {
        return $this->belongsTo('App\Person');
    }
}
