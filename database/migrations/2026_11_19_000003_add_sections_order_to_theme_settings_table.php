<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('theme_settings', function (Blueprint $table) {
            if (!Schema::hasColumn('theme_settings', 'sections_order')) {
                $table->json('sections_order')->nullable()->after('admin_sidebar_hover_text_color');
            }
        });
    }

    public function down(): void
    {
        Schema::table('theme_settings', function (Blueprint $table) {
            if (Schema::hasColumn('theme_settings', 'sections_order')) {
                $table->dropColumn('sections_order');
            }
        });
    }
};
