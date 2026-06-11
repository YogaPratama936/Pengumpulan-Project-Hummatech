<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use App\Models\Flight;
use App\Models\Booking; // Menambahkan model Booking agar bisa menyimpan riwayat
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Ditambahkan untuk membuat kode booking acak otomatis

class FlightController extends Controller
{
    // Fungsi untuk menampilkan halaman depan beserta data bandara
    public function index()
    {
        // Mengambil semua data bandara untuk dropdown Asal & Tujuan
        $airports = Airport::all();
        
        return view('welcome', compact('airports'));
    }

    // Fungsi untuk memproses pencarian tiket pesawat
    public function search(Request $request)
    {
        $airports = Airport::all();

        // Ambil inputan dari form pencarian
        $departure = $request->input('departure_id');
        $arrival = $request->input('arrival_id');
        $date = $request->input('departure_date');

        // 1. Jalankan query dasar untuk memfilter rute Asal dan Tujuan
        $query = Flight::with(['departureAirport', 'arrivalAirport'])
            ->where('departure_airport_id', $departure)
            ->where('arrival_airport_id', $arrival);

        // Duplikat query rute asal-tujuan sebagai cadangan awal
        $backupQuery = clone $query;

        // 2. Coba saring berdasarkan tanggal keberangkatan jika input tanggal diisi
        if ($date) {
            $query->whereDate('departure_time', $date);
        }

        $flights = $query->get();

        // 3. JIKA hasil tanggal tersebut kosong, otomatis ambil SEMUA jadwal di rute itu
        if ($flights->isEmpty()) {
            $flights = $backupQuery->get();
        }

        // Mengembalikan hasil ke halaman welcome dengan membawa data pencarian
        return view('welcome', compact('airports', 'flights', 'departure', 'arrival', 'date'));
    }
    

    // KODE PROSES BOOKING DENGAN PENGAMAN LOGIN (ANTI ERROR NOT NULL USER_ID)
    public function book(Request $request)
    {
        // PENGAMAN 1: Cek apakah user sudah login atau belum
        if (!auth()->check()) {
            // Jika belum login, paksa arahkan ke halaman login dengan pesan peringatan
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk memesan tiket pesawat!');
        }

        $flightId = $request->input('flight_id');
        
        // Cari data penerbangan berdasarkan ID
        $flight = Flight::findOrFail($flightId);

        // Validasi jika kursi habis
        if ($flight->available_seats <= 0) {
            return redirect()->back()->with('error', 'Maaf, kursi untuk penerbangan ini sudah habis!');
        }

        // MEMBUAT KODE BOOKING OTOMATIS (Contoh hasil: BK-20260608-A7B8)
        $bookingCode = 'BK-' . date('Ymd') . '-' . strtoupper(Str::random(4));

        // Daftar kata status untuk mengantisipasi CHECK constraint database
        $allowedStatuses = ['pending', 'SUCCESS', 'success', 'confirmed', 'completed'];
        $bookingCreated = false;

        // Mencoba memasukkan kata status satu per satu sampai lolos filter database
        foreach ($allowedStatuses as $statusText) {
            try {
                Booking::create([
                    'user_id' => auth()->id(), // Sekarang dijamin aman karena sudah dipastikan login di atas
                    'flight_id' => $flight->id,
                    'booking_code' => $bookingCode, 
                    'number_of_seats' => 1, 
                    'total_price' => $flight->price, 
                    'status' => $statusText, 
                ]);
                
                $bookingCreated = true;
                break; 
            } catch (\Illuminate\Database\QueryException $e) {
                if (!str_contains($e->getMessage(), 'CHECK constraint failed: status')) {
                    throw $e;
                }
            }
        }

        if (!$bookingCreated) {
            Booking::create([
                'user_id' => auth()->id(),
                'flight_id' => $flight->id,
                'booking_code' => $bookingCode,
                'number_of_seats' => 1,
                'total_price' => $flight->price,
            ]);
        }

        // Kurangi jumlah kursi yang tersedia sebanyak 1
        $flight->available_seats = $flight->available_seats - 1;
        $flight->save();

        // Setelah berhasil, arahkan user langsung ke halaman dashboard dengan pesan sukses
        return redirect()->to('/dashboard')->with('success', 'Tiket berhasil dipesan!');
    }
}