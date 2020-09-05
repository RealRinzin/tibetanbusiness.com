<?php

namespace App\LandingCarousel;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Carousel extends Model
{
    //
    //
    protected $connection = 'mysql';
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
}
