<?php

namespace App\Restaurant;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class RestaurantCommentReply extends Model
{
    //
    //
    protected $connection = 'restaurant';
    public $incrementing = false;
    // mass fill
    protected $guarded = [];
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($mode) {
            $mode->id = str_replace("-", "", Uuid::generate(4));
        });
    }
    // Relationships
    public function restaurant_comments()
    {
        return $this->belongsTo(RestaurantComment::class);
    }
}
