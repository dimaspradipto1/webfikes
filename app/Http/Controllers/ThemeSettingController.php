<?php

namespace App\Http\Controllers;

use App\Models\ThemeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use RealRashid\SweetAlert\Facades\Alert;

class ThemeSettingController extends Controller
{
    public function index()
    {
        $theme = ThemeSetting::current();
        return view('pages.theme-setting.index', compact('theme'));
    }

    public function update(Request $request)
    {
        $theme = ThemeSetting::current();

        $validated = $request->validate([
            'primary_color'                   => 'required|string|max:20',
            'primary_dark_color'              => 'required|string|max:20',
            'secondary_color'                 => 'required|string|max:20',
            'secondary_dark_color'            => 'required|string|max:20',
            'header_bg_color'                 => 'required|string|max:20',
            'header_text_color'               => 'required|string|max:20',
            'header_active_bg_color'          => 'required|string|max:20',
            'header_active_text_color'        => 'required|string|max:20',
            'header_pmb_bg_color'             => 'required|string|max:20',
            'header_pmb_text_color'           => 'required|string|max:20',
            'header_login_bg_color'           => 'required|string|max:20',
            'header_login_text_color'         => 'required|string|max:20',
            'header_lang_bg_color'            => 'required|string|max:20',
            'header_lang_text_color'          => 'required|string|max:20',
            'header_border_color'             => 'required|string|max:20',
            'hero_bg_color'                   => 'required|string|max:20',
            'hero_border_color'               => 'required|string|max:20',

            'footer_bg_color'                 => 'required|string|max:20',
            'footer_text_color'               => 'required|string|max:20',
            'footer_heading_color'            => 'required|string|max:20',
            'footer_border_top_color'         => 'required|string|max:20',
            'footer_link_color'               => 'required|string|max:20',
            'footer_link_hover_color'         => 'required|string|max:20',
            'footer_social_bg_color'          => 'required|string|max:20',
            'footer_social_text_color'        => 'required|string|max:20',

            'admin_primary_color'             => 'required|string|max:20',
            'admin_accent_color'              => 'required|string|max:20',
            'admin_header_bg_color'           => 'required|string|max:20',
            'admin_header_text_color'         => 'required|string|max:20',
            'admin_header_brand_color'        => 'required|string|max:20',
            'admin_header_border_color'       => 'required|string|max:20',
            'admin_sidebar_bg_color'          => 'required|string|max:20',
            'admin_sidebar_text_color'        => 'required|string|max:20',
            'admin_sidebar_active_bg_color'   => 'required|string|max:20',
            'admin_sidebar_active_text_color' => 'required|string|max:20',
            'admin_sidebar_hover_bg_color'    => 'required|string|max:20',
            'admin_sidebar_hover_text_color'  => 'required|string|max:20',
        ]);

        $validated['header_is_sticky'] = $request->has('header_is_sticky');

        $theme->update($validated);

        try {
            Artisan::call('view:clear');
        } catch (\Throwable $e) {
            // ignore
        }

        Alert::success('Berhasil!', 'Pengaturan warna Frontend & Admin berhasil disimpan.');
        return redirect()->route('theme.index');
    }

    public function reset()
    {
        $theme = ThemeSetting::current();
        $theme->update(ThemeSetting::defaultAttributes());

        try {
            Artisan::call('view:clear');
        } catch (\Throwable $e) {
            // ignore
        }

        Alert::success('Direset!', 'Pengaturan warna Frontend & Admin telah dikembalikan ke warna standar.');
        return redirect()->route('theme.index');
    }
}
