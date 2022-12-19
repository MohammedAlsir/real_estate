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
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->enum('type', [1, 2]); // النوع 1 ايجار عادي او  2 بيع مفروش
            $table->string('square'); // المربع
            $table->string('neighborhood'); // الحي
            $table->string('apartment_number')->nullable(); // رقم المنزل
            $table->integer('price'); // السعر
            $table->enum('rental', ['daily', 'monthly', 'yearly']); // سعر الاجار ان وجد
            $table->string('features')->nullable(); // المميزات
            $table->integer('space'); // المساحة
            // نوع المساحة
            // $table->foreignId('space_type_id')->constrained('space_types')->onDelete('cascade')->onUpdate('cascade');

            // $table->string('degree')->nullable(); // الدرجة
            $table->foreignId('state_id')->constrained('states')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('city_id')->constrained('cities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('apartments');
    }
};