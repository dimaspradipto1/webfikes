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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('judul_profil')->nullable();
            $table->text('deskripsi_profil_1')->nullable();
            $table->text('deskripsi_profil_2')->nullable();
            $table->text('visi')->nullable();
            $table->string('visi_judul')->nullable();
            $table->string('visi_icon')->nullable();
            $table->text('misi')->nullable();
            $table->string('misi_judul')->nullable();
            $table->string('misi_icon')->nullable();

            // Nilai Utama Kami Section
            $table->string('judul_nilai')->nullable();
            $table->text('deskripsi_nilai')->nullable();

            // Value Card 1
            $table->string('nilai_1_judul')->nullable();
            $table->text('nilai_1_deskripsi')->nullable();
            $table->string('nilai_1_icon')->nullable();

            // Value Card 2
            $table->string('nilai_2_judul')->nullable();
            $table->text('nilai_2_deskripsi')->nullable();
            $table->string('nilai_2_icon')->nullable();

            // Value Card 3
            $table->string('nilai_3_judul')->nullable();
            $table->text('nilai_3_deskripsi')->nullable();
            $table->string('nilai_3_icon')->nullable();

            // Value Card 4
            $table->string('nilai_4_judul')->nullable();
            $table->text('nilai_4_deskripsi')->nullable();
            $table->string('nilai_4_icon')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
