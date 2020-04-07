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
            $table->enum('home_delivery', ['0', '1']);
            $table->enum('wifi', ['0', '1']);
            $table->enum('party_booking', ['0', '1']);
            $table->enum('roof_top', ['0', '1']);
            $table->enum('ac', ['0', '1']);
            $table->enum('veg', ['0', '1']);
            $table->enum('none_veg', ['0', '1']);
            $table->enum('beverage', ['0', '1']);
            $table->enum('parking_lot', ['0', '1']);
            $table->enum('card_payment', ['0', '1']);
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
        Schema::dropIfExists('restaurant_facilities');
    }
}
