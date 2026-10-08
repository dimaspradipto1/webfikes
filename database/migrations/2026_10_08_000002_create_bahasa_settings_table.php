<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bahasa_settings', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 10)->unique();
            $table->string('nama', 100);
            $table->string('bendera', 255)->nullable();     // Boleh null (bisa file upload, path gambar, atau emoji)
            $table->string('kode_negara', 10)->nullable();  // Boleh null (bisa kode bendera negara seperti id, gb, sa, ps)
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });

        // Seed default languages based on requirements & reference image
        $defaultLanguages = [
            ['kode' => 'id',    'nama' => 'Bahasa Indonesia', 'bendera' => 'assets/img/flags/id.png', 'kode_negara' => 'id', 'urutan' => 1,  'is_active' => true, 'is_default' => true],
            ['kode' => 'en',    'nama' => 'English',          'bendera' => 'assets/img/flags/gb.png', 'kode_negara' => 'gb', 'urutan' => 2,  'is_active' => true, 'is_default' => false],
            ['kode' => 'ar',    'nama' => 'العربية',          'bendera' => 'assets/img/flags/sa.png', 'kode_negara' => 'sa', 'urutan' => 3,  'is_active' => true, 'is_default' => false],
            ['kode' => 'zh-CN', 'nama' => '简体中文',         'bendera' => 'assets/img/flags/cn.png', 'kode_negara' => 'cn', 'urutan' => 4,  'is_active' => true, 'is_default' => false],
            ['kode' => 'nl',    'nama' => 'Nederlands',       'bendera' => 'assets/img/flags/nl.png', 'kode_negara' => 'nl', 'urutan' => 5,  'is_active' => true, 'is_default' => false],
            ['kode' => 'tl',    'nama' => 'Filipino',         'bendera' => 'assets/img/flags/ph.png', 'kode_negara' => 'ph', 'urutan' => 6,  'is_active' => true, 'is_default' => false],
            ['kode' => 'fr',    'nama' => 'Français',         'bendera' => 'assets/img/flags/fr.png', 'kode_negara' => 'fr', 'urutan' => 7,  'is_active' => true, 'is_default' => false],
            ['kode' => 'de',    'nama' => 'Deutsch',          'bendera' => 'assets/img/flags/de.png', 'kode_negara' => 'de', 'urutan' => 8,  'is_active' => true, 'is_default' => false],
            ['kode' => 'hi',    'nama' => 'हिन्दी',             'bendera' => 'assets/img/flags/in.png', 'kode_negara' => 'in', 'urutan' => 9,  'is_active' => true, 'is_default' => false],
            ['kode' => 'it',    'nama' => 'Italiano',         'bendera' => 'assets/img/flags/it.png', 'kode_negara' => 'it', 'urutan' => 10, 'is_active' => true, 'is_default' => false],
            ['kode' => 'ko',    'nama' => '한국어',           'bendera' => 'assets/img/flags/kr.png', 'kode_negara' => 'kr', 'urutan' => 11, 'is_active' => true, 'is_default' => false],
            ['kode' => 'ja',    'nama' => '日本語',           'bendera' => 'assets/img/flags/jp.png', 'kode_negara' => 'jp', 'urutan' => 12, 'is_active' => true, 'is_default' => false],
            ['kode' => 'ps',    'nama' => 'Palestina',        'bendera' => 'assets/img/flags/ps.png', 'kode_negara' => 'ps', 'urutan' => 13, 'is_active' => true, 'is_default' => false],
        ];

        $now = now();
        foreach ($defaultLanguages as &$lang) {
            $lang['created_at'] = $now;
            $lang['updated_at'] = $now;
        }

        DB::table('bahasa_settings')->insert($defaultLanguages);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bahasa_settings');
    }
};
