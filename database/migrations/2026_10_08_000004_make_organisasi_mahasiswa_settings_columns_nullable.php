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
        Schema::table('organisasi_mahasiswa_settings', function (Blueprint $table) {
            $table->string('badge_teks')->nullable()->change();
            $table->string('judul')->nullable()->change();
            $table->string('judul_highlight')->nullable()->change();
            $table->text('deskripsi')->nullable()->change();
            $table->string('tombol_teks')->nullable()->change();
            $table->string('tombol_url')->nullable()->change();
            $table->string('hint_teks')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('organisasi_mahasiswa_settings', function (Blueprint $table) {
            //
        });
    }
};
