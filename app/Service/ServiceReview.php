<?php

namespace App\Service;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class ServiceReview extends Model
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
    public function service_basic_infos()
    {
        return $this->belongsTo(ServiceBasicInfo::class);
    }
    public function service_review_replies()
    {
        return $this->hasMany(ServiceReviewReply::class);
    }
}
