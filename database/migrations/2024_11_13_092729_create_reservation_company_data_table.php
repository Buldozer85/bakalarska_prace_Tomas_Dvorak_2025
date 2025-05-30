<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservation_company_data', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('representative_first_name');
            $table->string('representative_last_name');
            $table->string('ICO');
            $table->string('company_address');
            $table->string('representative_phone');
            $table->unsignedBigInteger('reservation_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservation_company_data');
    }
};
