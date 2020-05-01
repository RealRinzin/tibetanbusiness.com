<?php

use App\Rent\RentBasicInfo;
use App\Rent\RentComment;
use App\User;
use Illuminate\Database\Seeder;

class RentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(User::class, 2)->create();
        factory(RentBasicInfo::class, 2)->create();
        factory(RentComment::class, 2)->create();

    }
}
