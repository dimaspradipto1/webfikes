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
        Schema::create('pusat_informasi_humas', function (Blueprint $table) {
            $table->id();
            $table->string('judul')->nullable();
            $table->string('gambar')->nullable();
            $table->text('link_drive')->nullable();
            $table->string('button_text')->default('Lihat');
            $table->text('button_url')->nullable();
            $table->boolean('target_blank')->default(true);
            $table->integer('urutan')->default(1);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('pusat_informasi_humas_settings', function (Blueprint $table) {
            $table->id();
            $table->string('judul_seksi')->default('Hubungi Kami & Pusat Informasi');
            $table->string('subjudul_seksi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pusat_informasi_humas_settings');
        Schema::dropIfExists('pusat_informasi_humas');
    }
};
