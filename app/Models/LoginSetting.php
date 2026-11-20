<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class LoginSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'background_image',
        'brand_logo',
        'brand_title',
        'brand_subtitle',
        'back_button_text',
        'status_badge_text',
        'show_status_badge',
        'card_badge_text',
        'card_title',
        'card_subtitle',
        'email_label',
        'email_hint',
        'email_placeholder',
        'password_label',
        'password_placeholder',
        'remember_text',
        'submit_button_text',
        'show_alumni_card',
        'alumni_card_title',
        'alumni_card_subtitle',
        'security_badge_text',
        'copyright_text',
        'primary_color',
        'accent_color',
        'right_panel_bg_color',
        'card_bg_color',
    ];

    protected $casts = [
        'show_status_badge' => 'boolean',
        'show_alumni_card' => 'boolean',
    ];

    public static function defaultAttributes(): array
    {
        return [
            'background_image'     => null,
            'brand_logo'           => null,
            'brand_title'          => 'Fakultas Ilmu Kesehatan',
            'brand_subtitle'       => 'Portal Akademik & Administrasi Terpadu',
            'back_button_text'     => 'Kembali ke Beranda',
            'status_badge_text'    => 'Sistem Aktif',
            'show_status_badge'    => true,
            'card_badge_text'      => 'AUTENTIKASI AKUN',
            'card_title'           => 'Masuk ke Akun Anda',
            'card_subtitle'        => 'Gunakan kredensial resmi untuk mengakses panel kontrol sistem.',
            'email_label'          => 'Email Institusi / Akun',
            'email_hint'           => 'contoh: admin@uis.ac.id',
            'email_placeholder'    => 'nama@uis.ac.id',
            'password_label'       => 'Kata Sandi',
            'password_placeholder' => 'Masukkan kata sandi Anda',
            'remember_text'        => 'Ingat saya di perangkat ini',
            'submit_button_text'   => 'Masuk ke Portal',
            'show_alumni_card'     => true,
            'alumni_card_title'    => 'Alumni atau Mitra UIS?',
            'alumni_card_subtitle' => 'Kirimkan ulasan & testimoni tanpa perlu login',
            'security_badge_text'  => 'Koneksi aman SSL 256-bit • Portal Resmi UIS',
            'copyright_text'       => 'Fakultas Ilmu Kesehatan (FIKES). Hak cipta dilindungi.',
            'primary_color'        => '#046B26',
            'accent_color'         => '#FED802',
            'right_panel_bg_color' => '#eaf6ee',
            'card_bg_color'        => '#ffffff',
        ];
    }

    public static function current(): self
    {
        try {
            if (!Schema::hasTable('login_settings')) {
                return new self(self::defaultAttributes());
            }

            $setting = self::first();
            if (!$setting) {
                $setting = self::create(self::defaultAttributes());
            }

            return $setting;
        } catch (\Throwable $e) {
            return new self(self::defaultAttributes());
        }
    }

    public function getBackgroundImageUrlAttribute(): string
    {
        $bg = $this->attributes['background_image'] ?? null;
        if (!empty($bg)) {
            if (Storage::disk('public')->exists($bg) || file_exists(public_path('storage/' . $bg))) {
                return asset('storage/' . $bg);
            }
        }

        return asset('frontend/img/gedung-uis.jpg');
    }

    public function getBrandLogoUrlAttribute(): string
    {
        $logo = $this->attributes['brand_logo'] ?? null;
        if (!empty($logo)) {
            if (Storage::disk('public')->exists($logo) || file_exists(public_path('storage/' . $logo))) {
                return asset('storage/' . $logo);
            }
        }

        return asset('frontend/img/logouis.png');
    }

    public function hasCustomBackground(): bool
    {
        $bg = $this->attributes['background_image'] ?? null;
        return !empty($bg) && (Storage::disk('public')->exists($bg) || file_exists(public_path('storage/' . $bg)));
    }

    public function hasCustomLogo(): bool
    {
        $logo = $this->attributes['brand_logo'] ?? null;
        return !empty($logo) && (Storage::disk('public')->exists($logo) || file_exists(public_path('storage/' . $logo)));
    }
}
