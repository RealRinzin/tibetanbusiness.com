<?php

use App\Event\EventBasicInfo;
use App\Event\EventPhoto;
use App\Event\EventReview;
use App\Event\EventReviewReply;
use App\Job\JobAnswer;
use App\Job\JobApply;
use App\Job\JobBasicInfo;
use App\Job\JobInterest;
use App\Job\JobQuestion;
use App\Job\JobQuestionReply;
use App\Rent\RentBasicInfo;
use App\Rent\RentComment;
use App\Rent\RentFacility;
use App\Rent\RentRoomPhoto;
use App\Rent\RentViewPhoto;
use App\Restaurant\RestaurantBasicInfo;
use App\Restaurant\RestaurantComment;
use App\Restaurant\RestaurantCommentReply;
use App\Restaurant\RestaurantFacility;
use App\Restaurant\RestaurantFoodPhoto;
use App\Restaurant\RestaurantMenuPhoto;
use App\Restaurant\RestaurantOperationDay;
use App\Sale\SaleBasicInfo;
use App\Sale\SalePhoto;
use App\Service\ServiceBasicInfo;
use App\Service\ServicePhoto;
use App\Service\ServiceReview;
use App\Service\ServiceWorkingDay;
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
        // factory(RestaurantBasicInfo::class, 10)->create();
        // factory(RestaurantFacility::class, 2)->create();
        // factory(RestaurantOperationDay::class, 2)->create();
        // factory(RestaurantFoodPhoto::class, 2)->create();
        // factory(RestaurantMenuPhoto::class, 10)->create();
        // factory(RestaurantComment::class, 10)->create();
        // factory(RestaurantCommentReply::class,10)->create();
        // Rent DB Seed
        // factory(RentBasicInfo::class, 10)->create();
        // factory(RentComment::class, 10)->create();
        // factory(RentRoomPhoto::class, 10)->create();
        // factory(RentViewPhoto::class, 10)->create();
        // factory(RentFacility::class, 10)->create();

        // Job DB Seed
        // factory(JobBasicInfo::class,1)->create();
        // factory(JobApply::class, 1)->create();
        // factory(JobQuestion::class, 1)->create();
        // factory(JobQuestionReply::class,1)->create();
        // factory(JobInterest::class,1);

        // Event
        factory(EventBasicInfo::class,10)->create();
        factory(EventPhoto::class,8)->create();
        factory(EventReview::class,2)->create();
        factory(EventReviewReply::class, 2)->create();
        // SALE
        // factory(SaleBasicInfo::class,2)->create();
        // factory(SalePhoto::class,2)->create();

        // SERVICE
        // factory(ServiceBasicInfo::class, 2)->create();
        // factory(ServicePhoto::class, 2)->create();
        // factory(ServiceReview::class, 2)->create();
        // factory(ServiceWorkingDay::class, 2)->create();
    }
}
