<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Devotion extends Model
{
    protected $dates = ['devotion_date', 'created_at', 'updated_at', 'deleted_at'];
    protected $guarded = [];

    public function getDevotionDateAttribute($value){
        $dt = new Carbon($value);
        return $dt->format('Y-m-d');
        // return $dt->format('jS F, Y');
    }

}
