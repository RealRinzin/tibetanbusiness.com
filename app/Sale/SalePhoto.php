<?php

namespace App\Sale;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class SalePhoto extends Model
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
    public function sale_basic_infos()
    {
        return $this->belongsTo(SaleBasicInfo::class);
    }
}
