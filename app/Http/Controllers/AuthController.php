<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Tampilkan form login.
     * Jika sudah login, redirect sesuai role.
     */
    public function login()
    {
        if (Auth::check()) {
            return $this->redirectByRole();
        }

        return view('layouts.auth.login');
    }

    /**
     * Proses login menggunakan UserRequest (Form Request).
     * Validasi otomatis dijalankan sebelum method ini dipanggil.
     */
    public function loginproses(UserRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return $this->redirectByRole();
        }

        // Jika gagal login, kembali ke form dengan pesan error
        return back()
            ->withInput($request->only('email', 'remember'))
            ->withErrors([
                'email' => 'Email atau password salah. Silakan coba lagi.',
            ]);
    }

    /**
     * Proses logout user.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda berhasil logout.');
    }

    /**
     * Redirect ke halaman yang sesuai berdasarkan role user.
     */
    private function redirectByRole()
    {
        $role = Auth::user()->roles;

        return match ($role) {
            'admin' => to_route('dashboard')->with('success', 'Selamat datang kembali, Admin!'),
            default => to_route('dashboard')->with('success', 'Selamat datang!'),
        };
    }
}
