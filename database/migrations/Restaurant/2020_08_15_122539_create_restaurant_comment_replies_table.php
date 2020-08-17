<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantCommentRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('restaurant')->create('restaurant_comment_replies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->uuid('restaurant_comment_id');
            $table->string('rate_color', 20)->nullable();
            $table->string('reply');
            $table->string('name');
            $table->string('avatar');
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
        Schema::connection('restaurant')->dropIfExists('restaurant_comment_replies');
    }
}
