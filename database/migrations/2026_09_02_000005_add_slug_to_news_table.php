<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('title');
        });

        // Generate slug untuk berita yang sudah ada di database
        $items = DB::table('news')->get();
        foreach ($items as $item) {
            $baseSlug = Str::slug($item->title ?? '');
            if (empty($baseSlug)) {
                $baseSlug = 'berita-'.$item->id;
            }
            $slug = $baseSlug;
            $counter = 1;
            while (DB::table('news')->where('slug', $slug)->where('id', '!=', $item->id)->exists()) {
                $slug = "{$baseSlug}-{$counter}";
                $counter++;
            }
            DB::table('news')->where('id', $item->id)->update(['slug' => $slug]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
