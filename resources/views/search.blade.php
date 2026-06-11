<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hasil Pencarian Penerbangan - SkyLinee</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,800&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-slate-50 font-sans antialiased text-slate-800">

    <!-- Header / Navbar Minimalis -->
    <header class="bg-white border-b border-slate-100 shadow-sm sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 h-16 flex items-center justify-between">
            <a href="/" class="text-2xl font-black tracking-wider text-blue-600 flex items-center gap-1">
                ✈ SkyLinee
            </a>
            <a href="/" class="text-sm font-bold text-slate-600 hover:text-blue-600 transition">
                ↩ Ubah Pencarian
            </a>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-4 py-10">
        <!-- Informasi Rute Yang Dicari -->
        <div class="bg-white border border-slate-100 rounded-3xl p-6 shadow-xl shadow-slate-200/50 mb-8">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Hasil Pencarian Untuk</p>
            <h2 class="text-xl font-black text-slate-900 flex items-center gap-3 flex-wrap">
                <span>📍 {{ request('asal') }}</span>
                <span class="text-blue-500 font-medium">➔</span>
                <span>🏁 {{ request('tujuan') }}</span>
                <span class="text-slate-300 font-light">|</span>
                <span class="text-base text-slate-600 font-semibold">📅 {{ request('tanggal') ? date('d M Y', strtotime(request('tanggal'))) : 'Semua Tanggal' }}</span>
            </h2>
        </div>

        <!-- Daftar Tiket Penerbangan -->
        <div class="space-y-4">
            @forelse($flights as $flight)
                <div class="bg-white border border-slate-100 rounded-3xl p-6 shadow-xl shadow-slate-100 hover:shadow-blue-100/70 hover:border-blue-200 transition duration-300 flex flex-col md:flex-row md:items-center justify-between gap-6">
                    
                    <!-- Detail Maskapai & Waktu -->
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-2xl text-blue-600 shadow-inner">
                            ✈️
                        </div>
                        <div>
                            <h3 class="font-extrabold text-slate-900 text-lg">{{ $flight->airline ?? 'SkyLinee Airways' }}</h3>
                            <p class="text-xs text-slate-400 font-medium tracking-wide mt-0.5">Kode: {{ $flight->flight_number }}</p>
                            <div class="flex items-center gap-2 mt-2 text-sm text-slate-600 font-semibold">
                                <span>🕒 {{ date('H:i', strtotime($flight->departure_time)) }}</span>
                                <span class="text-slate-300 font-normal">➔</span>
                                <span>{{ date('H:i', strtotime($flight->arrival_time)) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Harga & Aksi -->
                    <div class="flex items-center justify-between md:justify-end gap-6 border-t md:border-t-0 pt-4 md:pt-0 border-slate-50">
                        <div class="md:text-right">
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Harga per Kursi</p>
                            <p class="text-2xl font-black text-blue-600 mt-0.5">Rp {{ number_format($flight->price, 0, ',', '.') }}</p>
                        </div>
                        
                        <!-- Form Booking Tiket -->
                        <form action="#" method="POST">
                            @csrf
                            <input type="hidden" name="flight_id" value="{{ $flight->id }}">
                            <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 font-bold text-white text-sm rounded-xl transition shadow-lg shadow-blue-200 cursor-pointer">
                                Pesan Tiket
                            </button>
                        </form>
                    </div>

                </div>
            @empty
                <!-- Jika Rute Penerbangan Tidak Ditemukan -->
                <div class="bg-white text-center py-16 px-4 border border-slate-100 rounded-3xl shadow-xl shadow-slate-200/40">
                    <div class="text-5xl mb-4">✈️❌</div>
                    <h3 class="text-lg font-extrabold text-slate-900">Penerbangan Tidak Tersedia</h3>
                    <p class="text-slate-400 text-sm mt-1 max-w-sm mx-auto">Maaf, jadwal penerbangan untuk rute dan tanggal pilihan Anda belum tersedia di database kami.</p>
                    <a href="/" class="mt-6 inline-block px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl transition">
                        Kembali ke Beranda
                    </a>
                </div>
            @endforelse
        </div>
    </main>

</body>
</html>