<?php

namespace App\Rent;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class RentRoomPhoto extends Model
{
    //
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
    // Relationship
    public function rent_basic_infos()
    {
        return $this->belongsTo(RentBasicInfo::class);
    }
}
