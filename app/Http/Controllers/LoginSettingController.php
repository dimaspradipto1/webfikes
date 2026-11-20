<?php

namespace App\Http\Controllers;

use App\Models\LoginSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class LoginSettingController extends Controller
{
    public function index()
    {
        $loginSetting = LoginSetting::current();
        return view('pages.login-setting.index', compact('loginSetting'));
    }

    public function update(Request $request)
    {
        $loginSetting = LoginSetting::current();

        $validated = $request->validate([
            'brand_title'          => 'required|string|max:120',
            'brand_subtitle'       => 'nullable|string|max:160',
            'back_button_text'     => 'required|string|max:80',
            'status_badge_text'    => 'required|string|max:80',
            'card_badge_text'      => 'required|string|max:80',
            'card_title'           => 'required|string|max:120',
            'card_subtitle'        => 'nullable|string|max:255',
            'email_label'          => 'required|string|max:100',
            'email_hint'           => 'nullable|string|max:100',
            'email_placeholder'    => 'required|string|max:100',
            'password_label'       => 'required|string|max:100',
            'password_placeholder' => 'required|string|max:100',
            'remember_text'        => 'required|string|max:120',
            'submit_button_text'   => 'required|string|max:100',
            'alumni_card_title'    => 'required|string|max:120',
            'alumni_card_subtitle' => 'nullable|string|max:200',
            'security_badge_text'  => 'nullable|string|max:160',
            'copyright_text'       => 'nullable|string|max:180',
            'primary_color'        => 'required|string|max:20',
            'accent_color'         => 'required|string|max:20',
            'right_panel_bg_color' => 'required|string|max:20',
            'card_bg_color'        => 'required|string|max:20',
            'background_image'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:20480',
            'brand_logo'           => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:20480',
        ]);

        $validated['show_status_badge'] = $request->has('show_status_badge');
        $validated['show_alumni_card'] = $request->has('show_alumni_card');

        // Background Image Upload / Removal
        if ($request->boolean('remove_background_image')) {
            if (!empty($loginSetting->background_image) && Storage::disk('public')->exists($loginSetting->background_image)) {
                Storage::disk('public')->delete($loginSetting->background_image);
            }
            $validated['background_image'] = null;
        } elseif ($request->hasFile('background_image')) {
            if (!empty($loginSetting->background_image) && Storage::disk('public')->exists($loginSetting->background_image)) {
                Storage::disk('public')->delete($loginSetting->background_image);
            }
            $validated['background_image'] = $request->file('background_image')->store('login', 'public');
        } else {
            unset($validated['background_image']);
        }

        // Brand Logo Upload / Removal
        if ($request->boolean('remove_brand_logo')) {
            if (!empty($loginSetting->brand_logo) && Storage::disk('public')->exists($loginSetting->brand_logo)) {
                Storage::disk('public')->delete($loginSetting->brand_logo);
            }
            $validated['brand_logo'] = null;
        } elseif ($request->hasFile('brand_logo')) {
            if (!empty($loginSetting->brand_logo) && Storage::disk('public')->exists($loginSetting->brand_logo)) {
                Storage::disk('public')->delete($loginSetting->brand_logo);
            }
            $validated['brand_logo'] = $request->file('brand_logo')->store('login', 'public');
        } else {
            unset($validated['brand_logo']);
        }

        $loginSetting->update($validated);

        try {
            Artisan::call('view:clear');
        } catch (\Throwable $e) {
            // ignore
        }

        Alert::success('Berhasil!', 'Pengaturan tampilan halaman Login berhasil disimpan.');
        return redirect()->route('login-setting.index');
    }

    public function reset()
    {
        $loginSetting = LoginSetting::current();

        if (!empty($loginSetting->background_image) && Storage::disk('public')->exists($loginSetting->background_image)) {
            Storage::disk('public')->delete($loginSetting->background_image);
        }
        if (!empty($loginSetting->brand_logo) && Storage::disk('public')->exists($loginSetting->brand_logo)) {
            Storage::disk('public')->delete($loginSetting->brand_logo);
        }

        $loginSetting->update(LoginSetting::defaultAttributes());

        try {
            Artisan::call('view:clear');
        } catch (\Throwable $e) {
            // ignore
        }

        Alert::success('Direset!', 'Tampilan halaman Login telah dikembalikan ke pengaturan standar.');
        return redirect()->route('login-setting.index');
    }
}
