<?php

namespace App\Http\Controllers;

use App\Models\NavbarSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class NavbarSettingController extends Controller
{
    public function index()
    {
        $navbarSetting = NavbarSetting::current();
        return view('pages.navbar-setting.index', compact('navbarSetting'));
    }

    public function update(Request $request)
    {
        $navbarSetting = NavbarSetting::current();

        $validated = $request->validate([
            'frontend_title'           => 'required|string|max:120',
            'frontend_subtitle'        => 'nullable|string|max:120',
            'admin_title'              => 'required|string|max:100',
            'admin_website_btn_text'   => 'required|string|max:60',
            'menu_beranda_label'       => 'required|string|max:60',
            'menu_profil_label'        => 'required|string|max:60',
            'menu_akademik_label'      => 'required|string|max:60',
            'menu_fakultas_label'      => 'required|string|max:60',
            'menu_kemahasiswaan_label' => 'required|string|max:60',
            'menu_publikasi_label'     => 'required|string|max:60',
            'menu_informasi_label'     => 'required|string|max:60',
            'menu_kontak_label'        => 'required|string|max:60',
            'pmb_btn_label'            => 'required|string|max:50',
            'pmb_btn_url'              => 'nullable|string|max:255',
            'login_btn_label'          => 'required|string|max:50',
            'frontend_logo'            => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:20480',
            'admin_logo'               => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:20480',
        ]);

        $toggles = [
            'show_admin_website_btn',
            'show_beranda',
            'show_profil',
            'show_akademik',
            'show_fakultas',
            'show_kemahasiswaan',
            'show_publikasi',
            'show_informasi',
            'show_kontak',
            'show_lang_btn',
            'show_pmb_btn',
            'show_login_btn',
        ];
        foreach ($toggles as $toggle) {
            $validated[$toggle] = $request->has($toggle);
        }

        // Upload / Remove Frontend Logo
        if ($request->boolean('remove_frontend_logo')) {
            if (!empty($navbarSetting->frontend_logo) && Storage::disk('public')->exists($navbarSetting->frontend_logo)) {
                Storage::disk('public')->delete($navbarSetting->frontend_logo);
            }
            $validated['frontend_logo'] = null;
        } elseif ($request->hasFile('frontend_logo')) {
            if (!empty($navbarSetting->frontend_logo) && Storage::disk('public')->exists($navbarSetting->frontend_logo)) {
                Storage::disk('public')->delete($navbarSetting->frontend_logo);
            }
            $validated['frontend_logo'] = $request->file('frontend_logo')->store('navbar', 'public');
        } else {
            unset($validated['frontend_logo']);
        }

        // Upload / Remove Admin Logo
        if ($request->boolean('remove_admin_logo')) {
            if (!empty($navbarSetting->admin_logo) && Storage::disk('public')->exists($navbarSetting->admin_logo)) {
                Storage::disk('public')->delete($navbarSetting->admin_logo);
            }
            $validated['admin_logo'] = null;
        } elseif ($request->hasFile('admin_logo')) {
            if (!empty($navbarSetting->admin_logo) && Storage::disk('public')->exists($navbarSetting->admin_logo)) {
                Storage::disk('public')->delete($navbarSetting->admin_logo);
            }
            $validated['admin_logo'] = $request->file('admin_logo')->store('navbar', 'public');
        } else {
            unset($validated['admin_logo']);
        }

        $navbarSetting->update($validated);

        try {
            Artisan::call('view:clear');
        } catch (\Throwable $e) {
            // ignore
        }

        Alert::success('Berhasil!', 'Pengaturan Navbar Frontend & Admin berhasil disimpan.');
        return redirect()->route('navbar-setting.index');
    }

    public function reset()
    {
        $navbarSetting = NavbarSetting::current();

        if (!empty($navbarSetting->frontend_logo) && Storage::disk('public')->exists($navbarSetting->frontend_logo)) {
            Storage::disk('public')->delete($navbarSetting->frontend_logo);
        }
        if (!empty($navbarSetting->admin_logo) && Storage::disk('public')->exists($navbarSetting->admin_logo)) {
            Storage::disk('public')->delete($navbarSetting->admin_logo);
        }

        $navbarSetting->update(NavbarSetting::defaultAttributes());

        try {
            Artisan::call('view:clear');
        } catch (\Throwable $e) {
            // ignore
        }

        Alert::success('Direset!', 'Pengaturan Navbar Frontend & Admin telah dikembalikan ke standar awal.');
        return redirect()->route('navbar-setting.index');
    }
}
