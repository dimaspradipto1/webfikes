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
        // 1. Tabel Daftar Akun Media Sosial
        Schema::create('social_medias', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('logo')->nullable(); // Upload file logo / icon PNG
            $table->string('icon')->nullable(); // Opsional class icon
            $table->string('url', 500);
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 2. Tabel Pengaturan Judul & Subjudul Header Seksi Media Sosial
        Schema::create('social_media_settings', function (Blueprint $table) {
            $table->id();
            $table->string('judul_seksi')->default('IKUTI UIS DI MEDIA SOSIAL');
            $table->text('subjudul_seksi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_media_settings');
        Schema::dropIfExists('social_medias');
    }
};
