<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('league_rounds', function (Blueprint $table) {
            $table->id();
            $table->integer('number');
            $table->boolean('is_finished');
            $table->date('from');
            $table->date('to');
            $table->unsignedBigInteger('league_id');
            $table->timestamps();

            $table->foreign('league_id')->references('id')->on('leagues')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('league_rounds');
    }
};
