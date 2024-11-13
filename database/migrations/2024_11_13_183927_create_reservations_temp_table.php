<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservations_temp', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->dateTime('slot_from');
            $table->dateTime('slot_to');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('reservation_area_id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('reservation_area_id')->references('id')->on('reservation_areas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations_temp');
    }
};
