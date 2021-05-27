<?php

namespace App\Job;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Webpatser\Uuid\Uuid;

class JobDocument extends Model
{

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
    public function users()
    {
        return $this->belongsTo(User::class);
    }
    public function Job_basic_infos()
    {
        return $this->belongsTo(JobBasicInfo::class);
    }
}
