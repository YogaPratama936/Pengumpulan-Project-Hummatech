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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke tabel users (siapa yang memesan)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Relasi ke tabel flights (penerbangan mana yang dipilih)
            $table->foreignId('flight_id')->constrained()->onDelete('cascade');
            
            $table->string('booking_code')->unique(); // Kode booking unik (contoh: ABCDE12)
            $table->integer('number_of_seats');      // Jumlah kursi yang dipesan
            $table->decimal('total_price', 10, 2);   // Total harga yang harus dibayar
            
            // Status pemesanan menggunakan enum
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};