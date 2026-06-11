<?php

use App\Http\Controllers\FlightController;
use Illuminate\Support\Facades\Route;

// Route Halaman Utama dan Pencarian
Route::get('/', [FlightController::class, 'index'])->name('home');
Route::get('/search', [FlightController::class, 'search'])->name('flights.search');

// KODE PENTING: Mendaftarkan rute memproses pesanan tiket agar tidak RouteNotFoundException
Route::post('/book-ticket', [FlightController::class, 'book'])->name('ticket.book');

// Route Dashboard: Mengambil riwayat booking milik user yang sedang login
Route::get('/dashboard', function () {
    $bookings = \App\Models\Booking::with(['flight.departureAirport', 'flight.arrivalAirport'])
        ->where('user_id', auth()->id())
        ->latest()
        ->get();

    return view('dashboard', compact('bookings'));
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';