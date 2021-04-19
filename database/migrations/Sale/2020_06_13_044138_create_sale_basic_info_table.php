<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleBasicInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('sale')->create('sale_basic_infos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->string('name', 50);
            $table->string('banner', 100);
            $table->string('card', 100);
            $table->string('thumb', 100);
            $table->decimal('price', 10, 0);
            $table->string('total_item', 2);
            $table->string('address', 250)->nullable();
            $table->text('location', 30);
            $table->double('longitude',5,2);
            $table->double('latitude',5,2);
            $table->text('type', 30);
            $table->string('mobile_no', 12);
            $table->boolean('status');
            $table->boolean('featured_ad')->nullable();
            $table->date('featured_ad_expire_date')->nullable();
            $table->boolean('home_ad')->nullable();
            $table->date('home_ad_expire_date')->nullable();
            $table->boolean('sidebar_ad')->nullable();
            $table->date('sidebar_ad_expire_date')->nullable();
            $table->boolean('popup_ad')->nullable();
            $table->date('popup_expire_date')->nullable();
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
        Schema::connection('sale')->dropIfExists('sale_basic_info');
    }
}
