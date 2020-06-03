<?php

namespace App;

use App\Event\EventBasicInfo;
use App\Job\JobBasicInfo;
use App\Rent\RentBasicInfo;
use App\Restaurant\RestaurantBasicInfo;
use Webpatser\Uuid\Uuid;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens,Notifiable;
    protected $connection = 'mysql';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'name', 'email', 'password',
    // ];
    // uuid
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
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * RELATIONSHIP 
     * TABLES
     *  */  
    // RESTAURANT
    public function restaurant_basic_infos()
    {
        return $this->hasMany(RestaurantBasicInfo::class);
    }
    // RENT
    public function rent_basic_infos()
    {
        return $this->hasMany(RentBasicInfo::class);
    }

    public function job_basic_infos()
    {
        return $this->hasMany(JobBasicInfo::class);
    }


    public function event_basic_infos()
    {
        return $this->hasMany(EventBasicInfo::class);
    }

}
