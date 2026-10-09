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
        if (!Schema::hasTable('unduhans')) {
            Schema::create('unduhans', function (Blueprint $table) {
                $table->id();
                $table->string('judul');
                $table->string('kategori', 50)->default('image'); // image, video, audio, template
                $table->string('file_path')->nullable();
                $table->string('file_url')->nullable();
                $table->string('file_size', 50)->nullable();
                $table->text('deskripsi')->nullable();
                $table->integer('urutan')->default(0);
                $table->boolean('is_active')->default(true);
                $table->unsignedBigInteger('download_count')->default(0);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unduhans');
    }
};
