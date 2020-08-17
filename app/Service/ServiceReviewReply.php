<?php

namespace App\Service;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class ServiceReviewReply extends Model
{
    //
    //
    //
    protected $connection = 'service';
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
    public function service_reviews()
    {
        return $this->belongsTo(ServiceReview::class);
    }
}
