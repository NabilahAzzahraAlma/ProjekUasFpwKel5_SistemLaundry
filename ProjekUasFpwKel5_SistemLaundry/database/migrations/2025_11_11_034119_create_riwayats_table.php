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
        Schema::create('riwayats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->string('status')->index(); // "Diterima", "Proses", "Selesai", "Ditolak"
            $table->unsignedBigInteger('changed_by_id')->nullable()->index(); // ID user yang ubah
            $table->string('changed_by_role')->nullable(); // "Staff", "Admin", "Driver"
            $table->text('notes')->nullable();
            $table->timestamps();

            // Relasi ke tabel orders
            $table->foreign('order_id')
                  ->references('id')
                  ->on('orders')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayats');
    }
};
