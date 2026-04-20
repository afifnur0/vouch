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
    Schema::create('streamer_settings', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');

        // 1. Overlay & Notifikasi
        $table->string('alert_image_url')->nullable();
        $table->string('alert_sound_url')->nullable();
        $table->decimal('tts_minimum_amount', 15, 2)->default(10000);

        // 2. Halaman Donasi Publik
        $table->text('page_bio')->nullable();
        $table->json('preset_amounts')->nullable(); // Disimpan dalam format JSON array

        // 3. Media Share
        $table->boolean('is_media_share_enabled')->default(false);
        $table->decimal('media_share_minimum_amount', 15, 2)->default(50000);

        // 4. Target Milestone
        $table->boolean('is_milestone_enabled')->default(true);
        $table->string('milestone_title')->nullable();
        $table->decimal('milestone_target_amount', 15, 2)->nullable();
        // Catatan: Progres nominal saat ini tidak perlu disimpan di sini, 
        // melainkan dikalkulasi dari total tabel transaksi (SUM) secara real-time.

        // 5. Filter Kata
        $table->boolean('is_default_filter_enabled')->default(true);
        $table->json('custom_banned_words')->nullable(); // Disimpan dalam format JSON array

        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('streamer_settings');
    }
};
