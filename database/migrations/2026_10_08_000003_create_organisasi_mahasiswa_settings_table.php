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
        Schema::create('organisasi_mahasiswa_settings', function (Blueprint $table) {
            $table->id();
            $table->string('badge_teks')->nullable()->default('LEMBAGA KEMAHASISWAAN · UIS');
            $table->string('judul')->nullable()->default('Kiprah & Kepemimpinan Mahasiswa UIS');
            $table->string('judul_highlight')->nullable()->default('Kepemimpinan');
            $table->text('deskripsi')->nullable();
            $table->string('tombol_teks')->nullable()->default('Jelajahi Semua Organisasi');
            $table->string('tombol_url')->nullable();
            $table->string('hint_teks')->nullable()->default('Scroll mouse atau geser kartu untuk menggulir ormawa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organisasi_mahasiswa_settings');
    }
};
