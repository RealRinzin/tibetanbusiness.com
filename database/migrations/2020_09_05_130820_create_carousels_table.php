<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarouselsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('other')->create('carousels', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('link');
            $table->string('type',30); //event,job,restaurant,rent etc
            $table->string('name',50); //Contributer name
            $table->string('photo',60);
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
        Schema::connection('other')->dropIfExists('carousels');
    }
}
