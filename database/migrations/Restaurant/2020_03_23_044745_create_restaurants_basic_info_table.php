<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantsBasicInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('restaurant')->create('restaurant_basic_infos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->string('name',80);
            $table->decimal('rate',5,1);
            $table->decimal('location',5,1);
            $table->text('address');
            $table->string('mobile_no',12);
            $table->string('email',100);
            $table->string('opening_hour',10);
            $table->string('closing_hour',10);
            $table->string('instagram',100);
            $table->string('facebook',100);
            $table->string('website',100);
            $table->enum('status',['0','1']);
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurants_basic_info');
    }
}
