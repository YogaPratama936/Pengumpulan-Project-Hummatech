<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // PERBAIKAN KODE: Menambahkan 'total_price' ke dalam fillable
    protected $fillable = [
        'user_id',
        'flight_id',
        'booking_code', 
        'number_of_seats',
        'total_price',
        'status',
    ];

    // Hubungan Relasi ke model Flight (Satu booking memiliki satu penerbangan)
    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }

    // Hubungan Relasi ke model User (Satu booking dimiliki oleh satu pengguna)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}