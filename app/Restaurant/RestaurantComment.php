<?php

namespace App\Restaurant;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class RestaurantComment extends Model
{
    // database connection
    protected $connection = 'restaurant';

    // mass fill
    protected $guarded = [];
    public $incrementing = false; //Disable ID increment
    // UUID
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($mode) {
            $mode->id = str_replace("-", "", Uuid::generate(4));
        });
    }
    // Relationship
    public function restaurant_comment_replies()
    {
        return $this->hasMany(RestaurantCommentReply::class);
    }
    //

}
