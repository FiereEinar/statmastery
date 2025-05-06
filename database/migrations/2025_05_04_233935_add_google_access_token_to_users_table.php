<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('gcalendar_access_token')->nullable();
            $table->text('gcalendar_refresh_token')->nullable();
            $table->text('gcalendar_user_info')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('gcalendar_access_token')->nullable();
            $table->dropColumn('gcalendar_refresh_token')->nullable();
            $table->dropColumn('gcalendar_user_info')->nullable();
        });
    }
};