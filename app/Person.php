<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $hidden = [
        'id',
    ];
    protected $guarded = [];
    protected $with =['user'];

public function user(){
    return $this->belongsTo(User::class);
}
    public function songs()
    {
        return $this->HasMany('App\Song');
    }
    public function events()
    {
        return $this->BelongsToMany('App\Event');
    }

}
