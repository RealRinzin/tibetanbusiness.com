<?php

namespace App\Job;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class JobQuestion extends Model
{
    //
    //
    //Rent connection
    protected $connection = 'job';
    protected $appends = ['repliesCount'];
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
    public function users()
    {
        return $this->belongsTo(User::class);
    }
    public function job_basic_infos()
    {
        return $this->belongsTo(JobBasicInfo::class);
    }
    
    public function job_question_replies()
    {
        return $this->hasMany(JobQuestionReply::class);
    }
    // Replies
    public function replies(){
        return $this->hasMany(JobQuestion::class,'job_question_id')->whereNotNull('job_question_id')->orderBy('created_at', 'desc');
    }
    // Count the replies
    public function getRepliesCountAttribute(){
        return $this->replies->count();
    }
}
