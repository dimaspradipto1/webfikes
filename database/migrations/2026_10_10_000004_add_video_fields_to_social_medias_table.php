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
        Schema::table('social_medias', function (Blueprint $table) {
            $table->string('handle')->nullable()->after('nama'); // e.g. @humas_uis / @universitasibnusina
            $table->string('video_url', 500)->nullable()->after('url'); // URL video (MP4, TikTok video, YouTube Shorts/video)
            $table->string('thumbnail_video')->nullable()->after('video_url'); // Upload cover/thumbnail video
            $table->string('video_judul')->nullable()->after('thumbnail_video'); // Judul/caption video terbaru
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('social_medias', function (Blueprint $table) {
            $table->dropColumn(['handle', 'video_url', 'thumbnail_video', 'video_judul']);
        });
    }
};
