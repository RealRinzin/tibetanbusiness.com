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
            $table->string('name',100);
            $table->string('card',100);
            $table->string('thumb', 100);
            $table->string('banner',80);
            $table->decimal('rate',5,1)->nullable();
            $table->string('rate_color', 15)->nullable();
            $table->string('address',250)->nullable();
            $table->double('longitude',5,2);
            $table->double('latitude',5,2);
            $table->text('location',30);
            $table->string('mobile_no',12);
            $table->string('email',100)->nullable();
            $table->string('opening_hour',10);
            $table->string('closing_hour',10);
            $table->string('instagram',100)->nullable();
            $table->string('facebook',100)->nullable();
            $table->string('website',100)->nullable();
            $table->boolean('status');
            $table->boolean('featured_ad')->nullable();
            $table->boolean('home_ad')->nullable();
            $table->boolean('sidebar_ad')->nullable();
            $table->text('description',225)->nullable();
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
        Schema::connection('restaurant')->dropIfExists('restaurants_basic_info');
    }
}
