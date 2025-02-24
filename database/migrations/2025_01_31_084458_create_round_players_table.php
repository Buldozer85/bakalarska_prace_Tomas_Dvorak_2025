<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('round_players', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('league_round_id');
            $table->unsignedBigInteger('league_player_id');
            $table->double('score');
            $table->dateTime('confirmed');
            $table->timestamps();
            $table->foreign('league_round_id')->references('id')->on('league_rounds')->onDelete('cascade');
            $table->foreign('league_player_id')->references('id')->on('league_players')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('round_players');
    }
};
