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
        Schema::table('pendampingan_acara_settings', function (Blueprint $table) {
            if (!Schema::hasColumn('pendampingan_acara_settings', 'konten')) {
                $table->longText('konten')->nullable()->after('sapaan');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendampingan_acara_settings', function (Blueprint $table) {
            if (Schema::hasColumn('pendampingan_acara_settings', 'konten')) {
                $table->dropColumn('konten');
            }
        });
    }
};
