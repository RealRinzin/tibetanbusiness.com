<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRentFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('rent')->create('rent_facilities', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('rent_basic_info_id');
            $table->boolean('wifi');
            $table->boolean('geyser');
            $table->boolean('ac');
            $table->boolean('washing_machine');
            $table->boolean('single_room');
            $table->boolean('double_room');
            $table->boolean('bathroom_attached');
            $table->boolean('fridge');
            $table->boolean('pet_allowed');
            $table->boolean('gym');
            $table->boolean('garden');
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
        Schema::dropIfExists('rent_facilities');
    }
}
