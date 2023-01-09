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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('photo');

            $table->foreignId('apartment_id')->nullable()->constrained('apartments')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('house_id')->nullable()->constrained('houses')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('parcel_id')->nullable()->constrained('parcels')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('hotel_id')->nullable()->constrained('hotels')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('images');
    }
};