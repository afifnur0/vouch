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
    Schema::create('bounties', function (Blueprint $table) {
        $table->id();
        $table->foreignId('donator_id')->constrained('users');
        $table->foreignId('streamer_id')->constrained('users');
        $table->string('quest_title');
        $table->decimal('amount', 15, 2);
        $table->enum('status', ['locked_in_escrow', 'completed', 'failed', 'refunded'])->default('locked_in_escrow');
        $table->timestamp('expires_at')->nullable();
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bounties');
    }
};
