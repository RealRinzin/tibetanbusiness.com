<?php

use App\Event\EventBasicInfo;
use App\Event\EventPhoto;
use App\Event\EventReview;
use App\Job\JobAnswer;
use App\Job\JobApply;
use App\Job\JobBasicInfo;
use App\Job\JobQuestion;
use App\Rent\RentBasicInfo;
use App\Rent\RentComment;
use App\Rent\RentFacility;
use App\Rent\RentRoomPhoto;
use App\Rent\RentViewPhoto;
use App\Restaurant\RestaurantBasicInfo;
use App\Restaurant\RestaurantComment;
use App\Restaurant\RestaurantFacility;
use App\Restaurant\RestaurantFoodPhoto;
use App\Restaurant\RestaurantMenuPhoto;
use App\Restaurant\RestaurantOperationDay;
use App\User;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 2)->create();
        
        // Restaurant DB Seed
        // factory(RestaurantBasicInfo::class, 2)->create();
        // factory(RestaurantFacility::class, 2)->create();
        // factory(RestaurantOperationDay::class, 2)->create();
        // factory(RestaurantFoodPhoto::class, 2)->create();
        // factory(RestaurantMenuPhoto::class, 10)->create();
        // factory(RestaurantComment::class, 2)->create();
        // Rent DB Seed
        // factory(RentBasicInfo::class, 2)->create();
        // factory(RentComment::class, 2)->create();
        // factory(RentRoomPhoto::class, 2)->create();
        // factory(RentViewPhoto::class, 2)->create();
        // factory(RentFacility::class, 2)->create();

        // Job DB Seed
        // factory(JobBasicInfo::class,2)->create();
        // factory(JobApply::class, 2)->create();
        // factory(JobQuestion::class, 10)->create();

        // Event
        factory(EventBasicInfo::class,1)->create();
        factory(EventPhoto::class,8)->create();
        // factory(EventReview::class,2)->create();

        
    }
}
