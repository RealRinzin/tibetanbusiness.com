<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantOperationDayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('restaurant')->create('restaurant_operation_days', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('restaurant_basic_info_id');
            $table->enum('monday', ['0', '1']);
            $table->enum('tuesday', ['0', '1']);
            $table->enum('wednesday', ['0', '1']);
            $table->enum('thursday', ['0', '1']);
            $table->enum('friday', ['0', '1']);
            $table->enum('saturday', ['0', '1']);
            $table->enum('sunday', ['0', '1']);
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
        Schema::dropIfExists('restaurant_operation_day');
    }
}
