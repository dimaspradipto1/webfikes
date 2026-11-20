<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('login_settings', function (Blueprint $table) {
            $table->id();

            // Left Showcase Panel (Image & Brand Pill)
            $table->string('background_image')->nullable();
            $table->string('brand_logo')->nullable();
            $table->string('brand_title', 120)->default('Universitas Ibnu Sina');
            $table->string('brand_subtitle', 160)->default('Portal Akademik & Administrasi Terpadu');

            // Topbar & Card Header
            $table->string('back_button_text', 80)->default('Kembali ke Beranda');
            $table->string('status_badge_text', 80)->default('Sistem Aktif');
            $table->boolean('show_status_badge')->default(true);
            $table->string('card_badge_text', 80)->default('AUTENTIKASI AKUN');
            $table->string('card_title', 120)->default('Masuk ke Akun Anda');
            $table->string('card_subtitle', 255)->default('Gunakan kredensial resmi untuk mengakses panel kontrol sistem.');

            // Form Labels & Placeholders
            $table->string('email_label', 100)->default('Email Institusi / Akun');
            $table->string('email_hint', 100)->nullable()->default('contoh: admin@uis.ac.id');
            $table->string('email_placeholder', 100)->default('nama@uis.ac.id');
            $table->string('password_label', 100)->default('Kata Sandi');
            $table->string('password_placeholder', 100)->default('Masukkan kata sandi Anda');
            $table->string('remember_text', 120)->default('Ingat saya di perangkat ini');
            $table->string('submit_button_text', 100)->default('Masuk ke Portal');

            // Alumni / Mitra Card & Footer
            $table->boolean('show_alumni_card')->default(true);
            $table->string('alumni_card_title', 120)->default('Alumni atau Mitra UIS?');
            $table->string('alumni_card_subtitle', 200)->default('Kirimkan ulasan & testimoni tanpa perlu login');
            $table->string('security_badge_text', 160)->nullable()->default('Koneksi aman SSL 256-bit • Portal Resmi UIS');
            $table->string('copyright_text', 180)->nullable()->default('Universitas Ibnu Sina (UIS). Hak cipta dilindungi.');

            // Colors
            $table->string('primary_color', 20)->default('#046B26');
            $table->string('accent_color', 20)->default('#FED802');
            $table->string('right_panel_bg_color', 20)->default('#eaf6ee');
            $table->string('card_bg_color', 20)->default('#ffffff');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('login_settings');
    }
};
