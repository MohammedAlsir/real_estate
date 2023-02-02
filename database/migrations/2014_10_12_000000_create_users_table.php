<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('type');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('status')->nullable();
            // For User
            $table->string('trade_name')->nullable();
            $table->string('license')->nullable();
            $table->string('address')->nullable();

            $table->string('personal_email')->nullable();
            $table->string('whatsapp_phone')->nullable();
            $table->string('logo')->nullable();
            $table->string('telegram_phone')->nullable();
            $table->string('facebook_account')->nullable();
            $table->string('twitter_account')->nullable();
            $table->string('photo')->nullable();




            $table->string('subscription_end')->nullable();



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
};
