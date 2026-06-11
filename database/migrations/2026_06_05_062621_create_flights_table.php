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
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->string('flight_number'); // Nomor penerbangan (contoh: GA-123)
            
            // Relasi ke tabel airports (Bandara Asal)
            $table->foreignId('departure_airport_id')->constrained('airports')->onDelete('cascade');
            
            // Relasi ke tabel airports (Bandara Tujuan)
            $table->foreignId('arrival_airport_id')->constrained('airports')->onDelete('cascade');
            
            $table->dateTime('departure_time'); // Waktu keberangkatan
            $table->dateTime('arrival_time');   // Waktu tiba
            $table->decimal('price', 10, 2);    // Harga tiket
            $table->integer('available_seats'); // Jumlah kursi yang tersedia
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};