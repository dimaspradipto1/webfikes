<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('theme_settings', function (Blueprint $table) {
            if (!Schema::hasColumn('theme_settings', 'header_height')) {
                $table->unsignedSmallInteger('header_height')->default(90)->after('header_border_color');
            }
            if (!Schema::hasColumn('theme_settings', 'admin_header_height')) {
                $table->unsignedSmallInteger('admin_header_height')->default(78)->after('admin_header_border_color');
            }
        });
    }

    public function down(): void
    {
        Schema::table('theme_settings', function (Blueprint $table) {
            $table->dropColumn(['header_height', 'admin_header_height']);
        });
    }
};
