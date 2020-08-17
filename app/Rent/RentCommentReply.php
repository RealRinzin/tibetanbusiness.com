<?php

namespace App\Rent;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class RentCommentReply extends Model
{
    //
    //
    protected $connection = 'rent';
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
    public function rent_comments()
    {
        return $this->belongsTo(RentComment::class);
    }
}
