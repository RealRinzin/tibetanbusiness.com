<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceBasicInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('service')->create('service_basic_infos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->string('name', 50);
            $table->text('type', 30);
            $table->decimal('rate', 5, 1)->nullable();
            $table->string('rate_color', 100)->nullable();
            $table->string('banner', 100);
            $table->string('card', 100);
            $table->string('thumb', 100);
            $table->string('address', 250)->nullable();
            $table->text('location', 30);
            $table->string('email', 250)->nullable();
            $table->string('mobile_no', 12);
            $table->string('opening_hour', 10);
            $table->string('closing_hour', 10);
            $table->string('instagram', 100)->nullable();
            $table->string('facebook', 100)->nullable();
            $table->string('website', 100)->nullable();
            $table->boolean('status');
            $table->boolean('featured_ad')->nullable();
            $table->date('featured_ad_expire_date')->nullable();
            $table->boolean('home_ad')->nullable();
            $table->date('home_ad_expire_date')->nullable();
            $table->boolean('sidebar_ad')->nullable();
            $table->date('sidebar_ad_expire_date')->nullable();
            $table->text('description', 225)->nullable();
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
        Schema::connection('service')->dropIfExists('service_basic_infos');
    }
}
