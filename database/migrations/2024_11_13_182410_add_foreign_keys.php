<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_addresses', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->onDelete('cascade')->on('users');
        });

        Schema::table('reservations', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('reservation_area_id')->references('id')->onDelete('cascade')->on('reservation_areas');
        });

        Schema::table('reservation_addresses', function (Blueprint $table) {
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade');
        });

        Schema::table('reservation_documents', function (Blueprint $table) {
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade');
        });
        Schema::table('reservation_company_data', function (Blueprint $table) {
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade');
        });

    }

    public function down(): void
    {
        Schema::table('user_addresses', function (Blueprint $table) {
            $table->dropForeign('user_id');
        });

        Schema::table('reservations', function (Blueprint $table) {
            $table->dropForeign('user_id');
            $table->dropForeign('reservation_area_id');
        });

        Schema::table('reservation_addresses', function (Blueprint $table) {
            $table->dropForeign('reservation_id');
        });

        Schema::table('reservation_documents', function (Blueprint $table) {
            $table->dropForeign('reservation_id');
        });
        Schema::table('reservation_company_data', function (Blueprint $table) {
            $table->dropForeign('reservation_id');
        });

    }
};
