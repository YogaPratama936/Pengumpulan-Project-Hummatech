<?php

namespace Database\Seeders;

use App\Models\Airport;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Menambahkan kolom 'country' karena wajib diisi di database kamu
        $airports = [
            ['name' => 'Soekarno-Hatta International Airport', 'code' => 'CGK', 'city' => 'Jakarta', 'country' => 'Indonesia'],
            ['name' => 'Juanda International Airport', 'code' => 'SUB', 'city' => 'Surabaya', 'country' => 'Indonesia'],
            ['name' => 'I Gusti Ngurah Rai International Airport', 'code' => 'DPS', 'city' => 'Bali', 'country' => 'Indonesia'],
            ['name' => 'Kualanamu International Airport', 'code' => 'KNO', 'city' => 'Medan', 'country' => 'Indonesia'],
            ['name' => 'Sultan Hasanuddin International Airport', 'code' => 'UPG', 'city' => 'Makassar', 'country' => 'Indonesia'],
            ['name' => 'Yogyakarta International Airport', 'code' => 'YIA', 'city' => 'Yogyakarta', 'country' => 'Indonesia'],
        ];

        foreach ($airports as $airport) {
            // updateOrCreate akan mengecek berdasarkan 'code'. Jika belum ada, dia akan membuat baru.
            Airport::updateOrCreate(
                ['code' => $airport['code']],
                [
                    'name' => $airport['name'], 
                    'city' => $airport['city'],
                    'country' => $airport['country'] // Memasukkan negara agar tidak NOT NULL error
                ]
            );
        }
    }
}