<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('username')->unique();

            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('skype')->nullable();

            $table->boolean('email_show')->default(false);
            $table->boolean('phone_show')->default(false);
            $table->boolean('skype_show')->default(false);

            $table->timestamp('email_verified_at')->nullable();

            $table->unsignedInteger('bonus_points')->default(0);
            $table->date('has_access_to_date')->nullable();
            
            $table->string('password');

            $table->rememberToken();

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
        Schema::dropIfExists('users');
    }
}
