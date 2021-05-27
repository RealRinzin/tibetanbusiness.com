<?php

namespace App\Job;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;


class JobBasicInfo extends Model
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

    // Relationships
    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function job_applies()
    {
        return $this->hasMany(JobApply::class);
    }
    public function job_interests()
    {
        return $this->hasMany(JobInterest::class);
    }
    public function job_documents()
    {
        return $this->hasMany(JobDocument::class);
    }
    public function job_questions()
    {
        return $this->hasMany(JobQuestion::class)->whereNull('job_question_id');
        // return $this->hasMany(JobQuestion::class);
    }
}
