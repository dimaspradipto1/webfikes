<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class NavbarSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'frontend_logo',
        'frontend_title',
        'frontend_subtitle',
        'admin_logo',
        'admin_title',
        'admin_website_btn_text',
        'show_admin_website_btn',
        'menu_beranda_label',
        'show_beranda',
        'menu_profil_label',
        'show_profil',
        'menu_akademik_label',
        'show_akademik',
        'menu_fakultas_label',
        'show_fakultas',
        'menu_kemahasiswaan_label',
        'show_kemahasiswaan',
        'menu_publikasi_label',
        'show_publikasi',
        'menu_informasi_label',
        'show_informasi',
        'menu_kontak_label',
        'show_kontak',
        'show_lang_btn',
        'show_pmb_btn',
        'pmb_btn_label',
        'pmb_btn_url',
        'show_login_btn',
        'login_btn_label',
    ];

    protected $casts = [
        'show_admin_website_btn' => 'boolean',
        'show_beranda'           => 'boolean',
        'show_profil'            => 'boolean',
        'show_akademik'          => 'boolean',
        'show_fakultas'          => 'boolean',
        'show_kemahasiswaan'     => 'boolean',
        'show_publikasi'         => 'boolean',
        'show_informasi'         => 'boolean',
        'show_kontak'            => 'boolean',
        'show_lang_btn'          => 'boolean',
        'show_pmb_btn'           => 'boolean',
        'show_login_btn'         => 'boolean',
    ];

    public static function defaultAttributes(): array
    {
        return [
            'frontend_logo'            => null,
            'frontend_title'           => 'FAKULTAS ILMU KESEHATAN',
            'frontend_subtitle'        => '',
            'admin_logo'               => null,
            'admin_title'              => 'Portal FIKES',
            'admin_website_btn_text'   => 'Website Utama',
            'show_admin_website_btn'   => true,
            'menu_beranda_label'       => 'Beranda',
            'show_beranda'             => true,
            'menu_profil_label'        => 'Profil',
            'show_profil'              => true,
            'menu_akademik_label'      => 'Akademik',
            'show_akademik'            => true,
            'menu_fakultas_label'      => 'Fakultas',
            'show_fakultas'            => true,
            'menu_kemahasiswaan_label' => 'Kemahasiswaan',
            'show_kemahasiswaan'       => true,
            'menu_publikasi_label'     => 'Publikasi',
            'show_publikasi'           => true,
            'menu_informasi_label'     => 'Informasi',
            'show_informasi'           => true,
            'menu_kontak_label'        => 'Kontak',
            'show_kontak'              => true,
            'show_lang_btn'            => true,
            'show_pmb_btn'             => true,
            'pmb_btn_label'            => 'PMB',
            'pmb_btn_url'              => null,
            'show_login_btn'           => true,
            'login_btn_label'          => 'Login',
        ];
    }

    public static function current(): self
    {
        try {
            if (!Schema::hasTable('navbar_settings')) {
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

    public function getFrontendLogoUrlAttribute(): string
    {
        $logo = $this->attributes['frontend_logo'] ?? null;
        if (!empty($logo) && (Storage::disk('public')->exists($logo) || file_exists(public_path('storage/' . $logo)))) {
            return asset('storage/' . $logo);
        }

        return asset('assets/img/logouis.png');
    }

    public function getAdminLogoUrlAttribute(): string
    {
        $logo = $this->attributes['admin_logo'] ?? null;
        if (!empty($logo) && (Storage::disk('public')->exists($logo) || file_exists(public_path('storage/' . $logo)))) {
            return asset('storage/' . $logo);
        }

        return asset('frontend/img/logouis.png');
    }

    public function hasCustomFrontendLogo(): bool
    {
        $logo = $this->attributes['frontend_logo'] ?? null;
        return !empty($logo) && (Storage::disk('public')->exists($logo) || file_exists(public_path('storage/' . $logo)));
    }

    public function hasCustomAdminLogo(): bool
    {
        $logo = $this->attributes['admin_logo'] ?? null;
        return !empty($logo) && (Storage::disk('public')->exists($logo) || file_exists(public_path('storage/' . $logo)));
    }
}
