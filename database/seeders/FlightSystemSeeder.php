<?php

namespace Database\Seeders;

use App\Models\Flight;
use Illuminate\Database\Seeder;

class FlightSystemSeeder extends Seeder
{
    public function run(): void
    {
        // KODE LENGKAP: Jadwal Penerbangan untuk Semua Kota (ID 1 sampai 6)
        $flights = [
            // 1. RUTE: Jakarta (1) <-> Surabaya (2)
            [
                'flight_number' => 'SL-001',
                'departure_airport_id' => 1, // Jakarta
                'arrival_airport_id' => 2,   // Surabaya
                'departure_time' => '2026-06-19 08:00:00',
                'arrival_time' => '2026-06-19 09:30:00',
                'price' => 750000,
                'available_seats' => 50,
            ],
            [
                'flight_number' => 'SL-002',
                'departure_airport_id' => 2, // Surabaya
                'arrival_airport_id' => 1,   // Jakarta
                'departure_time' => '2026-06-19 11:00:00',
                'arrival_time' => '2026-06-19 12:30:00',
                'price' => 780000,
                'available_seats' => 50,
            ],
            
            // 2. RUTE: Medan (4) <-> Makassar (5)
            [
                'flight_number' => 'SL-003',
                'departure_airport_id' => 4, // Medan
                'arrival_airport_id' => 5,   // Makassar
                'departure_time' => '2026-06-19 10:00:00',
                'arrival_time' => '2026-06-19 14:00:00',
                'price' => 1200000,
                'available_seats' => 45,
            ],
            [
                'flight_number' => 'SL-004',
                'departure_airport_id' => 5, // Makassar
                'arrival_airport_id' => 4,   // Medan
                'departure_time' => '2026-06-19 15:00:00',
                'arrival_time' => '2026-06-19 19:00:00',
                'price' => 1250000,
                'available_seats' => 40,
            ],

            // 3. RUTE: Bali (3) <-> Yogyakarta (6)
            [
                'flight_number' => 'SL-005',
                'departure_airport_id' => 3, // Bali
                'arrival_airport_id' => 6,   // Yogyakarta
                'departure_time' => '2026-06-19 13:00:00',
                'arrival_time' => '2026-06-19 14:15:00',
                'price' => 850000,
                'available_seats' => 30,
            ],
            [
                'flight_number' => 'SL-006',
                'departure_airport_id' => 6, // Yogyakarta
                'arrival_airport_id' => 3,   // Bali
                'departure_time' => '2026-06-19 16:00:00',
                'arrival_time' => '2026-06-19 17:15:00',
                'price' => 890000,
                'available_seats' => 35,
            ],

            // 4. RUTE BARU: Jakarta (1) <-> Bali (3)
            [
                'flight_number' => 'SL-007',
                'departure_airport_id' => 1, // Jakarta
                'arrival_airport_id' => 3,   // Bali
                'departure_time' => '2026-06-19 07:00:00',
                'arrival_time' => '2026-06-19 09:50:00',
                'price' => 950000,
                'available_seats' => 60,
            ],
            [
                'flight_number' => 'SL-008',
                'departure_airport_id' => 3, // Bali
                'arrival_airport_id' => 1,   // Jakarta
                'departure_time' => '2026-06-19 10:30:00',
                'arrival_time' => '2026-06-19 13:20:00',
                'price' => 980000,
                'available_seats' => 60,
            ],

            // 5. RUTE BARU: Surabaya (2) <-> Makassar (5)
            [
                'flight_number' => 'SL-009',
                'departure_airport_id' => 2, // Surabaya
                'arrival_airport_id' => 5,   // Makassar
                'departure_time' => '2026-06-19 06:30:00',
                'arrival_time' => '2026-06-19 08:00:00',
                'price' => 850000,
                'available_seats' => 40,
            ],
            [
                'flight_number' => 'SL-010',
                'departure_airport_id' => 5, // Makassar
                'arrival_airport_id' => 2,   // Surabaya
                'departure_time' => '2026-06-19 09:00:00',
                'arrival_time' => '2026-06-19 10:30:00',
                'price' => 870000,
                'available_seats' => 45,
            ],

            // 6. RUTE BARU: Yogyakarta (6) <-> Jakarta (1)
            [
                'flight_number' => 'SL-011',
                'departure_airport_id' => 6, // Yogyakarta
                'arrival_airport_id' => 1,   // Jakarta
                'departure_time' => '2026-06-19 07:15:00',
                'arrival_time' => '2026-06-19 08:25:00',
                'price' => 650000,
                'available_seats' => 50,
            ],
            [
                'flight_number' => 'SL-012',
                'departure_airport_id' => 1, // Jakarta
                'arrival_airport_id' => 6,   // Yogyakarta
                'departure_time' => '2026-06-19 14:30:00',
                'arrival_time' => '2026-06-19 15:40:00',
                'price' => 670000,
                'available_seats' => 50,
            ],

            // 7. RUTE BARU: Medan (4) <-> Jakarta (1)
            [
                'flight_number' => 'SL-013',
                'departure_airport_id' => 4, // Medan
                'arrival_airport_id' => 1,   // Jakarta
                'departure_time' => '2026-06-19 11:15:00',
                'arrival_time' => '2026-06-19 13:35:00',
                'price' => 1100000,
                'available_seats' => 40,
            ],
            [
                'flight_number' => 'SL-014',
                'departure_airport_id' => 1, // Jakarta
                'arrival_airport_id' => 4,   // Medan
                'departure_time' => '2026-06-19 16:00:00',
                'arrival_time' => '2026-06-19 18:20:00',
                'price' => 1150000,
                'available_seats' => 42,
            ],
             
        ];

        foreach ($flights as $flight) {
            Flight::updateOrCreate(
                ['flight_number' => $flight['flight_number']],
                $flight
            );
        }
    }
}