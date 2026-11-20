<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('navbar_settings')) {
            Schema::create('navbar_settings', function (Blueprint $table) {
                $table->id();

                // Frontend Brand
                $table->string('frontend_logo')->nullable();
                $table->string('frontend_title', 120)->default('UNIVERSITAS IBNU SINA');
                $table->string('frontend_subtitle', 120)->nullable();

                // Admin Brand
                $table->string('admin_logo')->nullable();
                $table->string('admin_title', 100)->default('Portal UIS');
                $table->string('admin_website_btn_text', 60)->default('Website Utama');
                $table->boolean('show_admin_website_btn')->default(true);

                // Frontend Menu Labels & Visibility
                $table->string('menu_beranda_label', 60)->default('Beranda');
                $table->boolean('show_beranda')->default(true);

                $table->string('menu_profil_label', 60)->default('Profil');
                $table->boolean('show_profil')->default(true);

                $table->string('menu_akademik_label', 60)->default('Akademik');
                $table->boolean('show_akademik')->default(true);

                $table->string('menu_fakultas_label', 60)->default('Fakultas');
                $table->boolean('show_fakultas')->default(true);

                $table->string('menu_kemahasiswaan_label', 60)->default('Kemahasiswaan');
                $table->boolean('show_kemahasiswaan')->default(true);

                $table->string('menu_publikasi_label', 60)->default('Publikasi');
                $table->boolean('show_publikasi')->default(true);

                $table->string('menu_informasi_label', 60)->default('Informasi');
                $table->boolean('show_informasi')->default(true);

                $table->string('menu_kontak_label', 60)->default('Kontak');
                $table->boolean('show_kontak')->default(true);

                // Frontend Right Action Buttons
                $table->boolean('show_lang_btn')->default(true);
                $table->boolean('show_pmb_btn')->default(true);
                $table->string('pmb_btn_label', 50)->default('PMB');
                $table->string('pmb_btn_url', 255)->nullable();
                $table->boolean('show_login_btn')->default(true);
                $table->string('login_btn_label', 50)->default('Login');

                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('navbar_settings');
    }
};
