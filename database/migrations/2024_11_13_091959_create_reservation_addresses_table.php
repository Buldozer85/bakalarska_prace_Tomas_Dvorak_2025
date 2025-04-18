<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservation_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('street');
            $table->string('town');
            $table->string('postcode');
            $table->string('number');
            $table->string('country');
            $table->unsignedBigInteger('reservation_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservation_addresses');
    }
};
