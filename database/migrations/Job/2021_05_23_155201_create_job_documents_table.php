<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('job')->create('job_documents', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('job_basic_info_id');
            $table->uuid('user_id');
            $table->string('path', 50);
            $table->string('thumb', 50);
            $table->string('extension', 25);
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
        Schema::connection('job')->dropIfExists('job_documents');

    }
}
