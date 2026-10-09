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
        Schema::create('desain_grafis_settings', function (Blueprint $table) {
            $table->id();
            $table->string('hero_title')->default('Desain Mudah,');
            $table->string('hero_highlight')->default('Siap Digunakan !');
            $table->text('hero_subtitle')->nullable();
            $table->string('order_box_title')->default('Pesan desain disini');
            $table->text('order_box_text')->nullable();
            $table->string('order_box_btn_text')->default('Pesan Sekarang');
            $table->string('order_box_wa_url')->nullable();
            $table->string('track_bar_text')->default('Lacak progress pesanan desain kamu disini!');
            $table->integer('stat_total')->default(82);
            $table->integer('stat_selesai')->default(74);
            $table->integer('stat_dikerjakan')->default(2);
            $table->integer('stat_menunggu')->default(5);
            $table->string('guide_title')->default('Langkah Menggunakan Templat Desain');
            $table->text('guide_steps')->nullable();
            $table->string('guide_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desain_grafis_settings');
    }
};
