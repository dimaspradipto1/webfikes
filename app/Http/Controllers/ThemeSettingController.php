<?php

namespace App\Http\Controllers;

use App\Models\ThemeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
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
            'header_height'                   => 'nullable|integer|min:60|max:160',
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
            'admin_header_height'             => 'nullable|integer|min:56|max:140',
            'admin_sidebar_bg_color'          => 'required|string|max:20',
            'admin_sidebar_text_color'        => 'required|string|max:20',
            'admin_sidebar_active_bg_color'   => 'required|string|max:20',
            'admin_sidebar_active_text_color' => 'required|string|max:20',
            'admin_sidebar_hover_bg_color'    => 'required|string|max:20',
            'admin_sidebar_hover_text_color'  => 'required|string|max:20',
        ]);

        $validated['header_is_sticky'] = $request->has('header_is_sticky');
        $validated['header_height'] = $request->filled('header_height') ? (int) $request->header_height : 90;
        $validated['admin_header_height'] = $request->filled('admin_header_height') ? (int) $request->admin_header_height : 78;

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

    public function liveState()
    {
        $theme = ThemeSetting::current();
        $themeData = $theme->only(array_keys(ThemeSetting::defaultAttributes()));
        $themeHash = md5(json_encode($themeData));

        $tables = [
            'banners', 'abouts', 'layanans', 'publikasis', 'news', 'dosens',
            'galleries', 'prestasis', 'organisasi_mahasiswas', 'contacts',
            'bahasa_settings', 'pmb_settings', 'sambutan_dekans', 'visi_misis',
            'faculty_stats', 'testimonials', 'faqs', 'partners', 'saranas',
            'struktur_organisasis', 'milestones', 'topbars', 'hero_humas',
            'layanan_humas', 'pusat_informasi_humas', 'unduhans', 'desain_grafis',
            'template_dokumens',
        ];

        $parts = [];
        foreach ($tables as $tbl) {
            try {
                if (Schema::hasTable($tbl)) {
                    $row = DB::table($tbl)->selectRaw('COUNT(*) as c, MAX(updated_at) as u')->first();
                    $parts[] = $tbl . ':' . ($row->c ?? 0) . ':' . ($row->u ?? '');
                }
            } catch (\Throwable $e) {
                // ignore table if no updated_at
            }
        }

        $contentHash = md5(implode('|', $parts));

        return response()->json([
            'theme'        => $themeData,
            'theme_hash'   => $themeHash,
            'content_hash' => $contentHash,
        ])->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
    }
}
