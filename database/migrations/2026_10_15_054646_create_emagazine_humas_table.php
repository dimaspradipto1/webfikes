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
        Schema::create('emagazine_humas', function (Blueprint $table) {
            $table->id();
            $table->string('judul_seksi')->default('E-Magazine Profil Universitas');
            $table->boolean('is_active')->default(true);

            // Tab 1: E-Magazine
            $table->string('tab_1_label')->default('E-Magazine');
            $table->string('tab_1_badge_text')->default('PROFIL 2026');
            $table->string('tab_1_cover_image')->nullable();
            $table->string('tab_1_judul')->default('E-Magazine Edisi Eksklusif Profil Kampus');
            $table->text('tab_1_deskripsi')->nullable();
            $table->string('tab_1_btn_preview_text')->default('Pratinjau Interaktif');
            $table->string('tab_1_btn_preview_url', 1000)->nullable();
            $table->string('tab_1_btn_download_text')->default('Unduh Dokumen');
            $table->string('tab_1_file_download', 255)->nullable();
            $table->string('tab_1_download_url', 1000)->nullable();

            // Tab 2: Buku Saku
            $table->string('tab_2_label')->default('Buku Saku');
            $table->string('tab_2_badge_text')->default('BUKU SAKU');
            $table->string('tab_2_cover_image')->nullable();
            $table->string('tab_2_judul')->default('Buku Saku Panduan Mahasiswa & Akademik');
            $table->text('tab_2_deskripsi')->nullable();
            $table->string('tab_2_btn_preview_text')->default('Pratinjau Interaktif');
            $table->string('tab_2_btn_preview_url', 1000)->nullable();
            $table->string('tab_2_btn_download_text')->default('Unduh Dokumen');
            $table->string('tab_2_file_download', 255)->nullable();
            $table->string('tab_2_download_url', 1000)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emagazine_humas');
    }
};
