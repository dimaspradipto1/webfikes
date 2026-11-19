<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class ThemeSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        // Frontend Brand & Header
        'primary_color',
        'primary_dark_color',
        'secondary_color',
        'secondary_dark_color',
        'header_bg_color',
        'header_text_color',
        'header_active_bg_color',
        'header_active_text_color',
        'header_pmb_bg_color',
        'header_pmb_text_color',
        'header_login_bg_color',
        'header_login_text_color',
        'header_lang_bg_color',
        'header_lang_text_color',
        'header_border_color',
        'header_is_sticky',
        'hero_bg_color',
        'hero_border_color',

        // Frontend Footer
        'footer_bg_color',
        'footer_text_color',
        'footer_heading_color',
        'footer_border_top_color',
        'footer_link_color',
        'footer_link_hover_color',
        'footer_social_bg_color',
        'footer_social_text_color',

        // Admin / Dashboard
        'admin_primary_color',
        'admin_accent_color',
        'admin_header_bg_color',
        'admin_header_text_color',
        'admin_header_brand_color',
        'admin_header_border_color',
        'admin_sidebar_bg_color',
        'admin_sidebar_text_color',
        'admin_sidebar_active_bg_color',
        'admin_sidebar_active_text_color',
        'admin_sidebar_hover_bg_color',
        'admin_sidebar_hover_text_color',
    ];

    protected $casts = [
        'header_is_sticky' => 'boolean',
    ];

    public static function defaultAttributes(): array
    {
        return [
            'primary_color'                  => '#046B26',
            'primary_dark_color'             => '#03521d',
            'secondary_color'                => '#FED802',
            'secondary_dark_color'           => '#e5c302',
            'header_bg_color'                => '#046B26',
            'header_text_color'              => '#ffffff',
            'header_active_bg_color'         => '#FED802',
            'header_active_text_color'       => '#046B26',
            'header_pmb_bg_color'            => '#FED802',
            'header_pmb_text_color'          => '#046B26',
            'header_login_bg_color'          => '#ffffff',
            'header_login_text_color'        => '#046B26',
            'header_lang_bg_color'           => '#03521d',
            'header_lang_text_color'         => '#ffffff',
            'header_border_color'            => '#FED802',
            'header_is_sticky'               => true,
            'hero_bg_color'                  => '#046B26',
            'hero_border_color'              => '#FED802',

            'footer_bg_color'                => '#03521d',
            'footer_text_color'              => '#ffffff',
            'footer_heading_color'           => '#FED802',
            'footer_border_top_color'        => '#FED802',
            'footer_link_color'              => '#ffffff',
            'footer_link_hover_color'        => '#FED802',
            'footer_social_bg_color'         => '#FED802',
            'footer_social_text_color'       => '#046B26',

            'admin_primary_color'            => '#046B26',
            'admin_accent_color'             => '#FED802',
            'admin_header_bg_color'          => '#046B26',
            'admin_header_text_color'        => '#ffffff',
            'admin_header_brand_color'       => '#FED802',
            'admin_header_border_color'      => '#FED802',
            'admin_sidebar_bg_color'         => '#ffffff',
            'admin_sidebar_text_color'       => '#046B26',
            'admin_sidebar_active_bg_color'  => '#eaf6ee',
            'admin_sidebar_active_text_color'=> '#046B26',
            'admin_sidebar_hover_bg_color'   => '#f8fcf9',
            'admin_sidebar_hover_text_color' => '#FED802',
        ];
    }

    public static function current(): self
    {
        try {
            if (!Schema::hasTable('theme_settings')) {
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
}
