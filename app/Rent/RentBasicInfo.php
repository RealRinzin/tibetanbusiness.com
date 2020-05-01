<?php

namespace App\Rent;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class RentBasicInfo extends Model
{
    //Rent connection
    protected $connection = 'rent';
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

    // Relationships
    public function users()
    {
        return $this->belongsTo(User::class);
    }
    // Relationships
    public function rent_facilities()
    {
        return $this->hasMany(RentFacility::class);
    }
    public function rent_room_photos()
    {
        return $this->hasMany(RentRoomPhoto::class);
    }
    public function rent_view_photos()
    {
        return $this->hasMany(RentViewPhoto::class);
    }
    public function rent_comments()
    {
        return $this->hasMany(RentComment::class);
    }

}
