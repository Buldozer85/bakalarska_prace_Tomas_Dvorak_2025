<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->dateTime('slot_from');
            $table->dateTime('slot_to');
            $table->unsignedBigInteger('user_id');
            $table->dateTime('confirmed')->nullable();
            $table->dateTime('changed')->nullable();
            $table->dateTime('cancelled')->nullable();
            $table->dateTime('payed')->nullable();
            $table->text('note')->nullable();
            $table->boolean('with_areal');
            $table->string('type');
            $table->string('phone');
            $table->text('purpose_of_rent');
            $table->unsignedBigInteger('reservation_area_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
