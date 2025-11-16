<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('complaints', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained(); // Pelanggan yang mengajukan
        $table->string('type'); // Tipe komplain (misal: Kualitas, Keterlambatan)
        $table->text('description');
        $table->string('status')->default('pending'); // Status: pending, verified, rejected
        $table->string('evidence')->nullable(); // Bukti komplain
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};


