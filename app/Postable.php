<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Postable extends Model
{
    protected $fillable = ['postable_id', 'postable_type'];

    public function postable(){
        return $this->morphTo();
    }
}
