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
            $table->unsignedBigInteger('order_id');
            $table->string('status'); // contoh: "Diterima", "Proses", "Selesai"
            $table->unsignedBigInteger('changed_by_id')->nullable(); // ID staff yang ubah
            $table->string('changed_by_role')->nullable(); // contoh: "Staff", "Admin"
            $table->text('notes')->nullable(); // catatan tambahan
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
