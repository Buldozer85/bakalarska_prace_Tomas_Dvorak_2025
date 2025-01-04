<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('message');
            $table->dateTime('sent');
            $table->dateTime('viewed')->nullable()->default(null);
            $table->timestamps();
            $table->unsignedBigInteger('conversation_id');
            $table->foreign('conversation_id')->references('id')->on('conversations')->onDelete('cascade');
            $table->string('sender_email');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
