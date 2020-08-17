<?php

namespace App\Event;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class EventReviewReply extends Model
{
    //
    //Rent connection
    protected $connection = 'event';
    // Increment
    public $incrementing = false;
    protected $guarded = [];
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($mode) {
            $mode->id = str_replace("-", "", Uuid::generate(4));
        });
    }
    // mass fill
    public function users()
    {
        return $this->belongsTo(User::class);
    }
    public function event_reviews()
    {
        return $this->belongsTo(EventReview::class);
    }

}
