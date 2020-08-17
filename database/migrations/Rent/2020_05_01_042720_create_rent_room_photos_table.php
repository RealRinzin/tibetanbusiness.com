<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRentRoomPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('rent')->create('rent_room_photos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('rent_basic_info_id');
            $table->uuid('user_id');
            $table->string('path');
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
        Schema::connection('rent')->dropIfExists('rent_room_photos');
    }
}
