<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Post extends Model
{
    protected $guarded = [];
    public function event()
    {
        return $this->hasOne('App\Event');
    }
    public function events()
    {
        return $this->morphedByMany('App\Event', 'eventable');
    }
    function user()
    {
        $this->hasMany(App\Post);
    }
    function t()
    {
        return Post::where('user_id', 1)->get();
    }
}
