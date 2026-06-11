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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke tabel bookings (pembayaran untuk booking yang mana)
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            
            $table->string('payment_method'); // Contoh: Transfer Bank, E-Wallet, Kartu Kredit
            $table->decimal('amount', 10, 2);   // Jumlah uang yang dibayar
            
            // Status pembayaran
            $table->enum('status', ['pending', 'success', 'failed'])->default('pending');
            
            $table->timestamp('payment_date')->nullable(); // Waktu sukses membayar
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};