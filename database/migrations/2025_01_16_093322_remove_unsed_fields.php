<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn('phone');
        });

        Schema::table('reservation_company_data', function (Blueprint $table) {
            $table->dropColumn('representative_first_name');
            $table->dropColumn('representative_last_name');
            $table->dropColumn('representative_phone');
        });
    }

    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->string('phone');
        });

        Schema::table('reservation_company_data', function (Blueprint $table) {
            $table->string('representative_first_name');
            $table->string('representative_last_name');
            $table->string('representative_phone');
        });
    }
};
