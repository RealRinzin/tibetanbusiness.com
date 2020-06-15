<?php

namespace App\Sale;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class SaleBasicInfo extends Model
{
    //
    protected $connection = 'sale';
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

    public function users()
    {
        return $this->belongsTo(User::class);
    }
    public function sale_photos()
    {
        return $this->hasMany(SalePhoto::class);
    }
}
