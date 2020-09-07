<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsBasicInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('event')->create('event_basic_infos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->decimal('rate',5,1)->nullable();
            $table->string('rate_color')->nullable();
            $table->string('name', 160);
            $table->string('banner', 80);
            $table->string('card', 80);
            $table->string('thumb', 80);
            $table->string('email', 100);
            $table->boolean('entry_free')->nullable();
            $table->string('location', 30);
            $table->decimal('entry_fee',10,0)->nullable();
            $table->string('category', 50);
            $table->string('address', 150);
            $table->string('mobile_no', 12);
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->text('description', 225)->nullable();
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
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
        Schema::connection('event')->dropIfExists('events_basic_info');
    }
}
