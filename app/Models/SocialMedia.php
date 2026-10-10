<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    use HasFactory;

    protected $table = 'social_medias';

    protected $fillable = [
        'nama',
        'handle',
        'logo',
        'icon',
        'url',
        'video_url',
        'thumbnail_video',
        'video_judul',
        'urutan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'urutan'    => 'integer',
    ];

    /**
     * Get logo asset URL or null
     */
    public function getLogoUrlAttribute(): ?string
    {
        if ($this->logo) {
            if (str_starts_with($this->logo, 'http://') || str_starts_with($this->logo, 'https://')) {
                return $this->logo;
            }
            if (str_starts_with($this->logo, 'assets/')) {
                return asset($this->logo);
            }
            return asset('storage/' . $this->logo);
        }
        return null;
    }

    /**
     * Get thumbnail video URL or null
     */
    public function getThumbnailVideoUrlAttribute(): ?string
    {
        if ($this->thumbnail_video) {
            if (str_starts_with($this->thumbnail_video, 'http://') || str_starts_with($this->thumbnail_video, 'https://')) {
                return $this->thumbnail_video;
            }
            if (str_starts_with($this->thumbnail_video, 'assets/') || str_starts_with($this->thumbnail_video, 'frontend/')) {
                return asset($this->thumbnail_video);
            }
            return asset('storage/' . $this->thumbnail_video);
        }
        return null;
    }

    /**
     * Check if thumbnail is a video file (mp4, webm, etc.)
     */
    public function isVideoFile(): bool
    {
        if (!$this->thumbnail_video) {
            return false;
        }
        $ext = strtolower(pathinfo($this->thumbnail_video, PATHINFO_EXTENSION));
        return in_array($ext, ['mp4', 'webm', 'ogg', 'mov']);
    }

    /**
     * Detect platform from video_url
     */
    public function getVideoPlatformAttribute(): ?string
    {
        if (empty($this->video_url)) {
            return null;
        }
        $url = strtolower($this->video_url);
        if (str_contains($url, 'tiktok.com')) return 'tiktok';
        if (str_contains($url, 'youtube.com') || str_contains($url, 'youtu.be')) return 'youtube';
        if (str_contains($url, 'instagram.com')) return 'instagram';
        if (str_contains($url, 'facebook.com') || str_contains($url, 'fb.watch')) return 'facebook';
        return 'other';
    }

    /**
     * Get embed URL for iframe preview / player
     */
    public function getVideoEmbedUrlAttribute(): ?string
    {
        if (empty($this->video_url)) {
            return null;
        }

        $url = trim($this->video_url);

        // If iframe tag pasted, extract src
        if (preg_match('/src=["\']([^"\']+)["\']/i', $url, $matches)) {
            return $matches[1];
        }

        // YouTube: watch?v=, youtu.be/, shorts/, embed/
        if (preg_match('/(?:youtube\.com\/(?:watch\?v=|shorts\/|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/i', $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1] . '?rel=0';
        }

        // TikTok: matches /video/, /photo/, /embed/v2/, /embed/, /v/, or numeric ID (15-25 digits)
        if (str_contains(strtolower($url), 'tiktok.com')) {
            if (preg_match('/(?:\/(?:video|photo|embed\/v2|embed|v|player\/v1)\/)?(\d{15,25})/i', $url, $matches)) {
                return 'https://www.tiktok.com/player/v1/' . $matches[1];
            }
        }

        // Instagram: instagram.com/reel/CODE or instagram.com/p/CODE
        if (preg_match('/instagram\.com\/(?:reel|p)\/([a-zA-Z0-9_-]+)/i', $url, $matches)) {
            return 'https://www.instagram.com/reel/' . $matches[1] . '/embed/';
        }

        // Direct video
        if (preg_match('/\.(mp4|webm|ogg)$/i', $url)) {
            return $url;
        }

        return null;
    }
}
