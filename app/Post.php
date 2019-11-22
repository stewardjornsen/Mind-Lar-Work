<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    function user(){
        $this->hasMany(App\Post);
    }
    function t(){
        return Post::where('user_id', 1)->get();
    }
}
