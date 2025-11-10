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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->string('order_code');
            $table->foreign('order_code')->references('order_code')->on('orders')->onDelete('cascade');
            $table->string('metode')->nullable();
            $table->string('kode_qr')->nullable();
            $table->string('virtual_account')->nullable();
            $table->decimal('jumlah', 10, 2)->default(0);
            $table->string('status')->default('pending');
            $table->timestamps();

            $table->foreign('order_code')
                ->references('order_code')
                ->on('orders')
                ->onDelete('cascade')
                ->name('fk_pembayarans_order_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
