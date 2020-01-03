<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $with = ['post', 'songs', 'videos', 'articles', 'files'];
    protected $dates = [
        // 'created_at',
        // 'updated_at',
        'start_date',
        'end_date'
    ];

    // public function getStartDateAttribute($value)
    // {
    //     return Carbon::parse($value)->format('F j, Y H:m a');
    // }
    // public function getEndDateAttribute($value)
    // {
    //     return Carbon::parse($value)->format('F j, Y H:m a');
    // }

    /*
     POLYMORPHIC RELATIONSHIPS
    */

    public function songs()
    {
        return $this->morphedByMany('App\Song', 'eventable');
    }
    public function videos()
    {
        return $this->morphedByMany('App\Video', 'eventable');
    }

    public function articles()
    {
        return $this->morphedByMany('App\Article', 'eventable');
    }
    public function files()
    {
        return $this->morphedByMany('App\File', 'eventable');
    }








    public function posts()
    {
        return $this->morphToMany('App\Post', 'postable');
    }
    public function photos()
    {
        return $this->morphMany('App\Photo', 'photoable');
    }

    /*
    REGULAR RELATIONSHIPS
    */

    public function post()
    {
        return $this->belongsTo('App\Post');
    }
    public function persons()
    {
        return $this->BelongsToMany('App\Person');
    }

    public function media()
    {
        return $this->hasMany('App\Medium');
    }
    public function scopeCurrent()
    {
        return $this->with(['post'])->get()->filter(function ($item) {
            if (Carbon::now('Africa/Lagos')->between($item->start_date, $item->end_date)) {
                return $item;
            }
        });
    }
    public function scopeNext($query)
    {
        return $query->with(['post'])->whereDate('start_date', '>=', Carbon::now('Africa/Lagos'))
            ->orWhereDate('end_date', '>=', Carbon::now('Africa/Lagos'))
            ->orderBy('start_date', 'asc');
    }
    public function scopeUpcoming($query)
    {
        return $query->with(['post'])
            ->whereDate('end_date', '>=', Carbon::now('Africa/Lagos'))
            ->orderBy('start_date', 'asc');
    }
    public function scopePast($query)
    {
        return $query->with(['post'])
            ->whereDate('end_date', '<', Carbon::now('Africa/Lagos'))
            ->orderBy('start_date', 'asc');
    }
}
