<?php

namespace App\Location;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;
class Location extends Model
{
    //
    protected $connection = 'other';
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
