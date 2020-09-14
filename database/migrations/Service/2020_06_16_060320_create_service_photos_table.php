<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('service')->create('service_photos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('service_basic_info_id');
            $table->uuid('user_id');
            $table->string('path',100);
            $table->string('thumb',100);
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
        Schema::connection('service')->dropIfExists('service_photos');
    }
}
