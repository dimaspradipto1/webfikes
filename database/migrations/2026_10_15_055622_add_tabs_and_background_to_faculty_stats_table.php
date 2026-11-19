<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('faculty_stats', function (Blueprint $table) {
            // Background Image Banner
            $table->string('background_image')->nullable()->after('image');

            // Tab 1: Mahasiswa
            $table->string('tab_1_label')->default('Mahasiswa')->after('background_image');
            $table->unsignedInteger('mhs_total')->default(5273)->after('tab_1_label');
            $table->string('mhs_total_label')->default('Total Mahasiswa')->after('mhs_total');
            $table->unsignedInteger('mhs_baru')->default(1520)->after('mhs_total_label');
            $table->string('mhs_baru_label')->default('Jumlah Mahasiswa Baru 2026')->after('mhs_baru');
            $table->unsignedInteger('mhs_alumni')->default(7968)->after('mhs_baru_label');
            $table->string('mhs_alumni_label')->default('Alumni')->after('mhs_alumni');

            // Tab 2: Prestasi
            $table->string('tab_2_label')->default('Prestasi')->after('mhs_alumni_label');
            $table->unsignedInteger('prestasi_nasional')->default(37)->after('tab_2_label');
            $table->string('prestasi_nasional_label')->default('Nasional')->after('prestasi_nasional');
            $table->unsignedInteger('prestasi_provinsi')->default(39)->after('prestasi_nasional_label');
            $table->string('prestasi_provinsi_label')->default('Provinsi')->after('prestasi_provinsi');
            $table->unsignedInteger('prestasi_internasional')->default(10)->after('prestasi_provinsi_label');
            $table->string('prestasi_internasional_label')->default('International')->after('prestasi_internasional');

            // Tab 3: Kerjasama
            $table->string('tab_3_label')->default('Kerjasama')->after('prestasi_internasional_label');
            $table->unsignedInteger('kerjasama_total')->default(50)->after('tab_3_label');
            $table->string('kerjasama_total_label')->default('Jumlah Kerjasama')->after('kerjasama_total');
            $table->unsignedInteger('kerjasama_perusahaan')->default(8)->after('kerjasama_total_label');
            $table->string('kerjasama_perusahaan_label')->default('Perusahaan')->after('kerjasama_perusahaan');
            $table->unsignedInteger('kerjasama_pemerintahan')->default(19)->after('kerjasama_perusahaan_label');
            $table->string('kerjasama_pemerintahan_label')->default('Pemerintahan')->after('kerjasama_pemerintahan');
            $table->unsignedInteger('kerjasama_sekolah')->default(5)->after('kerjasama_pemerintahan_label');
            $table->string('kerjasama_sekolah_label')->default('Sekolah')->after('kerjasama_sekolah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('faculty_stats', function (Blueprint $table) {
            $table->dropColumn([
                'background_image',
                'tab_1_label',
                'mhs_total',
                'mhs_total_label',
                'mhs_baru',
                'mhs_baru_label',
                'mhs_alumni',
                'mhs_alumni_label',
                'tab_2_label',
                'prestasi_nasional',
                'prestasi_nasional_label',
                'prestasi_provinsi',
                'prestasi_provinsi_label',
                'prestasi_internasional',
                'prestasi_internasional_label',
                'tab_3_label',
                'kerjasama_total',
                'kerjasama_total_label',
                'kerjasama_perusahaan',
                'kerjasama_perusahaan_label',
                'kerjasama_pemerintahan',
                'kerjasama_pemerintahan_label',
                'kerjasama_sekolah',
                'kerjasama_sekolah_label',
            ]);
        });
    }
};
