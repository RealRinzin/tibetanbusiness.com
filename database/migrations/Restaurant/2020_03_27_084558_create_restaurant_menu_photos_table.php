<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantMenuPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('restaurant')->create('restaurant_menu_photos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('restaurant_basic_info_id');
            $table->uuid('user_id');
            $table->string('path',100);
            $table->string('card', 100);
            $table->string('thumb', 100);
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
        Schema::connection('restaurant')->dropIfExists('restaurant_menu_photos');
    }
}
