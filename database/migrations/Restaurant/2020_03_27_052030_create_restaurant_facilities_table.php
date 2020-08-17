<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('restaurant')->create('restaurant_facilities', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('restaurant_basic_info_id');
            $table->boolean('home_delivery');
            $table->boolean('wifi');
            $table->boolean('party_booking');
            $table->boolean('roof_top');
            $table->boolean('ac');
            $table->boolean('veg');
            $table->boolean('none_veg');
            $table->boolean('beverage');
            $table->boolean('parking_lot');
            $table->boolean('card_payment');
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
        Schema::connection('restaurant')->dropIfExists('restaurant_facilities');
    }
}
