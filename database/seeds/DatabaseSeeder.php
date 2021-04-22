<?php

use App\Event\EventBasicInfo;
use App\Event\EventInterest;
use App\Event\EventPhoto;
use App\Event\EventReview;
use App\Event\EventReviewReply;
use App\Job\JobApply;
use App\Job\JobBasicInfo;
use App\Job\JobInterest;
use App\LandingCarousel\Carousel;
use App\Job\JobQuestion;
use App\Job\JobQuestionReply;
use App\Rent\RentBasicInfo;
use App\Rent\RentComment;
use App\Rent\RentCommentReply;
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
use App\Service\ServiceReviewReply;
use App\Service\ServiceWorkingDay;
use App\User;
use App\EventCategory;
use App\Occupation;
use App\SaleCategory;
use App\ServiceCategory;
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
        factory(User::class, 1)->create();
        // // Event Category
        factory(EventCategory::class,10)->create();
        // // Sale Category /Product
        factory(SaleCategory::class, 10)->create();
        // // Occupation Category
        factory(Occupation::class, 10)->create();
        // // Service Category
        factory(ServiceCategory::class, 10)->create();
        factory(Carousel::class, 10)->create();


        // // ce015fe555df43a0848cf48cecee26ed
        // Restaurant DB Seed
        // factory(RestaurantBasicInfo::class, 10)->create();
        // factory(RestaurantFacility::class, 10)->create();
        // factory(RestaurantOperationDay::class, 10)->create();
        // factory(RestaurantFoodPhoto::class, 10)->create();
        // factory(RestaurantMenuPhoto::class, 10)->create();
        // factory(RestaurantComment::class, 10)->create();
        // factory(RestaurantCommentReply::class,10)->create();

        // // Rent DB Seed
        // factory(RentBasicInfo::class, 10)->create();
        // factory(RentComment::class, 10)->create();
        // factory(RentCommentReply::class,10)->create();
        // factory(RentRoomPhoto::class, 10)->create();
        // factory(RentViewPhoto::class, 10)->create();
        // factory(RentFacility::class, 10)->create();

        // // Job DB Seed
        // factory(JobBasicInfo::class,3)->create();
        // factory(JobApply::class, 10)->create();
        // factory(JobInterest::class, 10)->create();
        // factory(JobQuestion::class, 10)->create();
        // factory(JobQuestionReply::class,10)->create();
        // factory(JobInterest::class,10);

        // // Event
        // factory(EventBasicInfo::class,10)->create();
        // factory(EventPhoto::class,20)->create();
        // factory(EventInterest::class, 20)->create();
        // factory(EventReview::class,20)->create();
        // factory(EventReviewReply::class, 20)->create();

        // // SALE
        // factory(SaleBasicInfo::class,10)->create();
        // factory(SalePhoto::class,30)->create();

        // // SERVICE
        // factory(ServiceBasicInfo::class, 10)->create();
        // factory(ServicePhoto::class, 10)->create();
        // factory(ServiceReview::class, 10)->create();
        // factory(ServiceWorkingDay::class, 10)->create();
        // factory(ServiceReviewReply::class,10)->create();
    }
}
