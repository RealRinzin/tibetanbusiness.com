<?php

namespace App\Event;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class EventBasicInfo extends Model
{
    //
    //Rent connection
    protected $connection = 'event';
    // Increment
    public $incrementing = false;
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($mode) {
            $mode->id = str_replace("-", "", Uuid::generate(4));
        });
    }
    // mass fill
    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
    public function event_photos()
    {
        return $this->hasMany(EventPhoto::class);
    }
    public function event_reviews()
    {
        return $this->hasMany(EventReview::class);
    }
    public function event_interests()
    {
        return $this->hasMany(EventInterest::class);
    }
}
