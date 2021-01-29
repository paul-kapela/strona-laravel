<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_responses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id');
            $table->foreignId('request_id');
            $table->foreignId('answer_id')->nullable();

            $table->unsignedInteger('price');
            $table->boolean('accepted');
            $table->boolean('paid');

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
        Schema::dropIfExists('request_responses');
    }
}
