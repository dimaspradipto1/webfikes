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
        Schema::create('template_dokumens', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('tipe_file', 50)->nullable();
            $table->string('link_drive', 1000);
            $table->string('icon_preset', 50)->default('word'); // powerpoint, word, idcard, excel, pdf, custom
            $table->string('custom_icon', 255)->nullable();
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('template_dokumen_settings', function (Blueprint $table) {
            $table->id();
            $table->string('judul_seksi')->default('TEMPLAT DOKUMEN');
            $table->text('deskripsi_seksi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('template_dokumens');
        Schema::dropIfExists('template_dokumen_settings');
    }
};
