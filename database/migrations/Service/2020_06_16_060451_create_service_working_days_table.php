<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceWorkingDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('service')->create('service_working_days', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('service_basic_info_id');
            $table->boolean('monday', [true, false]);
            $table->boolean('tuesday', [true, false]);
            $table->boolean('wednesday', [true, false]);
            $table->boolean('thursday', [true, false]);
            $table->boolean('friday', [true, false]);
            $table->boolean('saturday', [true, false]);
            $table->boolean('sunday', [true, false]);
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
        Schema::connection('service')->dropIfExists('service_working_days');
    }
}
