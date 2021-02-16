<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class EventCategory extends Model
{
    //
    protected $connection = 'other';
    // public $incrementing = true;
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($mode) {
            $mode->id = str_replace("-", "", Uuid::generate(4));
        });
    }
    // Mass Fill
    protected $guarded = [];
    //
}
