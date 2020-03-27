<?php

namespace App\Restaurant;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;
use App\User;

class RestaurantBasicInfo extends Model
{
    protected $connection = 'restaurant';
    // protected $table = 'restaurant_basic_infos';
    // protected $table = 'restaurants'; 
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
    public function users()
    {
        return $this->belongsTo(User::class);
    }
    // Relationships
    public function restaurant_facilities()
    {
        return $this->hasMany(RestaurantFacility::class);
    }
    public function restaurant_operation_days()
    {
        return $this->hasMany(RestaurantOperationDay::class);
    }
}
