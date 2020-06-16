<?php

namespace App\Service;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class ServiceBasicInfo extends Model
{
    //
    protected $connection = 'service';
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
    public function users()
    {
        return $this->belongsTo(User::class);
    }
    public function service_photos()
    {
        return $this->hasMany(ServicePhoto::class);
    }
    public function service_reviews()
    {
        return $this->hasMany(ServiceReview::class);
    }
    public function service_working_days()
    {
        return $this->hasMany(ServiceWorkingDay::class);
    }
}
