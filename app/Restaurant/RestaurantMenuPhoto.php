<?php

namespace App\Restaurant;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class RestaurantMenuPhoto extends Model
{
    //
    protected $connection = 'restaurant';
    // uuid
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
    // Relationships
    // Relationship
    public function restaurant_basic_infos()
    {
        return $this->belongsTo(RestaurantBasicInfo::class);
    }
}
