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
            $table->string('name',50);
            $table->string('banner',80);
            $table->decimal('rate',5,1)->nullable();
            $table->string('rate_color', 15)->nullable();
            $table->string('address',250)->nullable();
            $table->decimal('longitude',10,6);
            $table->decimal('latitude',10,6);
            $table->text('location',30);
            $table->string('mobile_no',12);
            $table->string('email',100);
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
