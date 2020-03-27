<?php

use App\Restaurant\RestaurantBasicInfo;
use App\Restaurant\RestaurantFacility;
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
        factory(RestaurantBasicInfo::class, 2)->create();
        factory(RestaurantFacility::class, 2)->create();
        factory(RestaurantOperationDay::class, 2)->create();
    }
}
