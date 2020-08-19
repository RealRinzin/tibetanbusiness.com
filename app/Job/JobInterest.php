<?php

namespace App\Job;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class JobInterest extends Model
{
    //
    //Rent connection
    protected $connection = 'job';
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
    public function job_basic_infos()
    {
        return $this->belongsTo(JobBasicInfo::class);
    }
}
