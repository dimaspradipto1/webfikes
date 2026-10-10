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
        Schema::create('layanan_humas_items', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 50)->unique();
            $table->string('nama', 100);
            $table->string('icon', 50)->default('bi-grid');
            $table->string('badge_text', 50)->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('url', 1000)->nullable();
            $table->string('file_path', 255)->nullable();
            $table->boolean('target_blank')->default(false);
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
        Schema::dropIfExists('layanan_humas_items');
    }
};
