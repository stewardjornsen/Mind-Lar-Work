<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public function events()
    {
        return $this->morphToMany('App\Event', 'eventable');
    }
}
