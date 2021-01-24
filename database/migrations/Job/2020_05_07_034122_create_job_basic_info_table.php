<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobBasicInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('job')->create('job_basic_infos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->string('banner', 80);
            $table->string('card', 80);
            $table->string('thumb', 80);
            $table->string('title', 255);
            $table->string('organization', 255);
            $table->string('profession', 100);
            $table->string('experience', 35);
            $table->string('nature', 100);
            $table->string('address', 255)->nullable();
            $table->decimal('salary', 8, 0)->nullable();
            $table->string('location', 100);
            $table->double('longitude',5,2);
            $table->double('latitude',5,2);
            $table->string('mobile_no', 12)->nullable();
            $table->string('email', 100);
            $table->string('instagram', 100)->nullable();
            $table->string('facebook', 100)->nullable();
            $table->string('website', 100)->nullable();
            $table->date('deadline')->nullable();
            $table->boolean('status');
            $table->boolean('featured_ad')->nullable();
            $table->date('featured_ad_expire_date')->nullable();
            $table->boolean('home_ad')->nullable();
            $table->date('home_ad_expire_date')->nullable();
            $table->boolean('sidebar_ad')->nullable();
            $table->date('sidebar_ad_expire_date')->nullable();
            $table->text('description', 255)->nullable();
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
        Schema::connection('job')->dropIfExists('job_basic_infos');
    }
}
