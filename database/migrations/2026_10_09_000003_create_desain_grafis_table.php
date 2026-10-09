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
        Schema::create('desain_grafis', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('kategori')->default('audit'); // audit, sidang, dekanat, spanduk
            $table->string('badge_teks')->nullable(); // e.g. 'Landscape (704 x 320 px)'
            $table->string('spesifikasi')->nullable();
            $table->text('deskripsi')->nullable();
            $table->text('canva_url')->nullable();
            $table->string('gambar_preview')->nullable();
            $table->string('warna_gradient')->nullable()->default('linear-gradient(135deg, #0b6828 0%, #15803d 100%)');
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desain_grafis');
    }
};
