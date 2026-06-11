<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkyLinee - Pemesanan Tiket Pesawat</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-slate-50 font-sans antialiased text-slate-800 scroll-smooth">

    <nav class="bg-white/90 backdrop-blur-md sticky top-0 z-50 border-b border-slate-100/80 shadow-xs">
        <div class="max-w-7xl mx-auto px-6 sm:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center gap-2">
                    <a href="/" class="text-2xl font-black tracking-wider bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent flex items-center gap-2">
                        <span>✈</span> SkyLinee
                    </a>
                </div>

                <div class="hidden md:flex items-center gap-8 bg-slate-50 px-6 py-2.5 rounded-full border border-slate-200/40">
                    <a href="#" class="text-xs font-bold tracking-widest uppercase text-slate-600 hover:text-blue-600 transition">Home</a>
                    <a href="#about" class="text-xs font-bold tracking-widest uppercase text-slate-600 hover:text-blue-600 transition">About</a>
                    <a href="#contact" class="text-xs font-bold tracking-widest uppercase text-slate-600 hover:text-blue-600 transition">Contact</a>
                    <a href="#faq" class="text-xs font-bold tracking-widest uppercase text-slate-600 hover:text-blue-600 transition">FAQ</a>
                </div>

                <div class="flex items-center gap-3">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 text-xs font-bold tracking-wider uppercase text-slate-600 hover:text-blue-600 transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="px-6 py-2.5 text-xs font-bold tracking-wider uppercase text-slate-600 hover:text-blue-600 transition bg-slate-50 hover:bg-slate-100 rounded-full">Masuk</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-6 py-2.5 text-xs font-bold tracking-wider uppercase text-white bg-blue-600 hover:bg-blue-700 rounded-full shadow-lg shadow-blue-200 transition">Daftar</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <div class="relative bg-gradient-to-r from-slate-900 via-indigo-950 to-slate-900 pt-20 pb-28 px-6 sm:px-8 overflow-hidden">
        <div class="absolute inset-0 opacity-10 pointer-events-none flex items-center justify-center">
            <span class="text-[400px] text-white rotate-45 select-none">✈</span>
        </div>

        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12 items-center relative z-10">
            
            <div class="lg:col-span-5 space-y-6 text-center lg:text-left">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-blue-500/10 text-blue-400 border border-blue-400/20">
                     Solusi Perjalanan Terbaik Anda
                </span>
                <h1 class="text-3xl sm:text-5xl font-extrabold text-white leading-tight tracking-tight">
                    Jelajahi Dunia Bersama <span class="bg-gradient-to-r from-blue-400 to-indigo-300 bg-clip-text text-transparent">SkyLinee</span>
                </h1>
                <p class="text-slate-300 text-sm sm:text-base max-w-xl mx-auto lg:mx-0 leading-relaxed">
                    Temukan tiket pesawat dengan harga terbaik, rute terlengkap, dan proses pemesanan yang aman, mudah, dan cepat.
                </p>
            </div>

            <div class="lg:col-span-7">
                <div class="bg-white p-6 sm:p-8 rounded-3xl shadow-2xl border border-slate-100">
                    <h3 class="text-lg font-black text-slate-900 mb-6 flex items-center gap-2 tracking-wide uppercase">
                        🔍 Cari Penerbangan
                    </h3>
                    
                    <form action="{{ route('flights.search') }}" method="GET" class="space-y-5">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-1.5">Asal</label>
                                <div class="relative">
                                    <span class="absolute left-4 top-3.5 text-slate-400 text-sm">📍</span>
                                    <select name="departure_id" class="w-full bg-slate-50 border border-slate-200 text-slate-700 rounded-2xl pl-10 pr-4 py-3 focus:outline-none focus:border-blue-500 focus:bg-white transition text-sm font-semibold">
                                        @foreach($airports as $airport)
                                            <option value="{{ $airport->id }}" {{ isset($departure) && $departure == $airport->id ? 'selected' : '' }}>
                                                {{ $airport->city }} ({{ $airport->code }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-1.5">Tujuan</label>
                                <div class="relative">
                                    <span class="absolute left-4 top-3.5 text-slate-400 text-sm">🏁</span>
                                    <select name="arrival_id" class="w-full bg-slate-50 border border-slate-200 text-slate-700 rounded-2xl pl-10 pr-4 py-3 focus:outline-none focus:border-blue-500 focus:bg-white transition text-sm font-semibold">
                                        @foreach($airports as $airport)
                                            <option value="{{ $airport->id }}" {{ isset($arrival) && $arrival == $airport->id ? 'selected' : '' }}>
                                                {{ $airport->city }} ({{ $airport->code }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-1.5">Tanggal Pergi</label>
                            <div class="relative">
                                <span class="absolute left-4 top-3.5 text-slate-400 text-sm">📅</span>
                                <input type="date" name="departure_date" value="{{ $date ?? '' }}" class="w-full bg-slate-50 border border-slate-200 text-slate-700 rounded-2xl pl-10 pr-4 py-3 focus:outline-none focus:border-blue-500 focus:bg-white transition text-sm font-semibold" required>
                            </div>
                        </div>

                        <button type="submit" class="w-full py-4 px-6 font-bold text-xs tracking-widest uppercase text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 rounded-2xl shadow-xl shadow-blue-500/20 transition duration-300 cursor-pointer">
                            Cari Penerbangan
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <div id="about" class="max-w-7xl mx-auto px-6 sm:px-8 -mt-12 relative z-20">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="p-6 bg-white rounded-2xl border border-slate-100 shadow-xl flex items-center gap-4 group hover:border-blue-500/40 transition">
                <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl font-bold group-hover:scale-110 transition">💳</div>
                <div>
                    <h4 class="font-bold text-slate-900 text-sm">Pembayaran Aman</h4>
                    <p class="text-slate-400 text-xs mt-0.5">Metode terverifikasi penuh aman.</p>
                </div>
            </div>
            <div class="p-6 bg-white rounded-2xl border border-slate-100 shadow-xl flex items-center gap-4 group hover:border-blue-500/40 transition">
                <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl font-bold group-hover:scale-110 transition">🎫</div>
                <div>
                    <h4 class="font-bold text-slate-900 text-sm">E-Tiket Instan</h4>
                    <p class="text-slate-400 text-xs mt-0.5">Langsung terbit masuk dashboard.</p>
                </div>
            </div>
            <div class="p-6 bg-white rounded-2xl border border-slate-100 shadow-xl flex items-center gap-4 group hover:border-blue-500/40 transition">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl font-bold group-hover:scale-110 transition">🏷️</div>
                <div>
                    <h4 class="font-bold text-slate-900 text-sm">Harga Terbaik</h4>
                    <p class="text-slate-400 text-xs mt-0.5">Penawaran promo eksklusif harian.</p>
                </div>
            </div>
        </div>
    </div>

    @if(isset($flights))
        <div class="max-w-4xl mx-auto px-6 sm:px-8 mt-16 relative z-20">
            <h3 class="text-lg font-black text-slate-900 mb-6 flex items-center gap-2 uppercase tracking-wider">
                ✈️ Hasil Pencarian
            </h3>

            @if($flights->isEmpty())
                <div class="bg-amber-50/60 p-5 rounded-2xl border border-amber-200/60 flex items-center gap-3.5 shadow-sm">
                    <span class="text-xl text-amber-600">🔔</span>
                    <p class="text-amber-800 text-xs font-semibold leading-relaxed">
                        Maaf, tidak ada jadwal penerbangan yang tersedia untuk rute dan tanggal tersebut. Coba cari rute lain atau ubah tanggal keberangkatan Anda.
                    </p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($flights as $flight)
                        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-lg hover:shadow-xl hover:border-blue-500/40 transition duration-300 flex flex-col sm:flex-row justify-between items-center gap-6">
                            
                            <div class="flex items-center gap-4 w-full sm:w-auto">
                                <div class="w-12 h-12 bg-slate-50 border border-slate-100 rounded-xl flex items-center justify-center text-base text-slate-700 font-black">
                                    {{ substr($flight->flight_number, 0, 2) }}
                                </div>
                                <div>
                                    <span class="px-2 py-0.5 text-[10px] font-bold text-blue-600 bg-blue-50 rounded-md">
                                        {{ $flight->flight_number }}
                                    </span>
                                    <div class="flex items-center gap-4 mt-1.5">
                                        <div>
                                            <p class="text-base font-black text-slate-900">{{ \Carbon\Carbon::parse($flight->departure_time)->format('H:i') }}</p>
                                            <p class="text-[11px] font-bold text-slate-400">{{ $flight->departureAirport->city }} ({{ $flight->departureAirport->code }})</p>
                                        </div>
                                        <div class="text-slate-300 font-light text-sm">➔</div>
                                        <div>
                                            <p class="text-base font-black text-slate-900">{{ \Carbon\Carbon::parse($flight->arrival_time)->format('H:i') }}</p>
                                            <p class="text-[11px] font-bold text-slate-400">{{ $flight->arrivalAirport->city }} ({{ $flight->arrivalAirport->code }})</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center sm:text-left">
                                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Tersedia</p>
                                <p class="text-xs font-extrabold text-emerald-600 mt-0.5">{{ $flight->available_seats }} Kursi</p>
                            </div>

                            <div class="flex items-center gap-5 justify-between sm:justify-end w-full sm:w-auto border-t sm:border-t-0 pt-4 sm:pt-0 border-slate-100">
                                <div class="text-right">
                                    <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Harga Per Orang</p>
                                    <p class="text-xl font-black text-blue-600 mt-0.5">Rp {{ number_format($flight->price, 0, ',', '.') }}</p>
                                </div>
                                
                                <form action="{{ route('ticket.book') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="flight_id" value="{{ $flight->id }}">
                                    <button type="submit" class="px-5 py-3 font-bold text-xs uppercase tracking-wider text-white bg-blue-600 hover:bg-blue-700 rounded-xl transition cursor-pointer shadow-md shadow-blue-100">
                                        Pesan Tiket
                                    </button>
                                </form>
                            </div>

                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    @endif

    <div id="faq" class="max-w-4xl mx-auto px-6 sm:px-8 mt-16 relative z-20">
        <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-100 shadow-xl">
            <h3 class="text-sm font-black text-slate-900 mb-6 uppercase tracking-wider flex items-center gap-2">
                💡 Pertanyaan Umum & Tips (FAQ)
            </h3>
            
            <div class="space-y-3">
                <details class="group border border-slate-100 rounded-xl bg-slate-50/40 overflow-hidden transition">
                    <summary class="flex justify-between items-center p-4 font-bold text-slate-700 cursor-pointer list-none hover:bg-slate-50">
                        <span class="text-xs sm:text-sm">🗓️ Bagaimana cara mendapatkan tiket termurah?</span>
                        <span class="transition group-open:rotate-180 text-slate-400 text-xs">▼</span>
                    </summary>
                    <div class="p-4 pt-0 text-xs text-slate-500 leading-relaxed border-t border-slate-100 bg-white">
                        Biasanya tiket pada hari Selasa, Rabu, dan Kamis jauh lebih terjangkau dibandingkan keberangkatan akhir pekan.
                    </div>
                </details>

                <details class="group border border-slate-100 rounded-xl bg-slate-50/40 overflow-hidden transition">
                    <summary class="flex justify-between items-center p-4 font-bold text-slate-700 cursor-pointer list-none hover:bg-slate-50">
                        <span class="text-xs sm:text-sm">🌐 Apakah harga di SkyLinee real-time?</span>
                        <span class="transition group-open:rotate-180 text-slate-400 text-xs">▼</span>
                    </summary>
                    <div class="p-4 pt-0 text-xs text-slate-500 leading-relaxed border-t border-slate-100 bg-white">
                        Ya, seluruh jadwal penerbangan dan kuota kursi diupdate real-time langsung dari sistem database bandara utama.
                    </div>
                </details>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-6 sm:px-8 mt-8 mb-20 relative z-20">
        <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-100 shadow-xl">
            <h3 class="text-sm font-black text-slate-900 mb-1 uppercase tracking-wider">
                📍 Rute Penerbangan Terfavorit
            </h3>
            <p class="text-slate-400 text-[11px] mb-5">Pilihan rute penerbangan domestik paling diminati minggu ini.</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 text-xs">
                <a href="#" class="p-3 border border-slate-100 rounded-xl bg-slate-50/50 text-slate-600 font-bold hover:text-blue-600 hover:bg-blue-50/50 transition">✈️ Penerbangan ke Jakarta</a>
                <a href="#" class="p-3 border border-slate-100 rounded-xl bg-slate-50/50 text-slate-600 font-bold hover:text-blue-600 hover:bg-blue-50/50 transition">✈️ Penerbangan ke Surabaya</a>
                <a href="#" class="p-3 border border-slate-100 rounded-xl bg-slate-50/50 text-slate-600 font-bold hover:text-blue-600 hover:bg-blue-50/50 transition">✈️ Penerbangan ke Bali</a>
            </div>
        </div>
    </div>

    <footer id="contact" class="bg-white border-t border-slate-200/60 py-12 text-xs text-slate-400 relative z-20">
        <div class="max-w-4xl mx-auto px-6 sm:px-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h4 class="font-bold text-slate-700 mb-3 uppercase tracking-wider">📞 Hubungi Kami</h4>
                <p class="mb-1.5 hover:text-blue-600 cursor-pointer">Layanan Pelanggan 24 Jam</p>
                <p class="hover:text-blue-600 cursor-pointer">Pusat Bantuan Tiket Online</p>
            </div>
            <div>
                <h4 class="font-bold text-slate-700 mb-3 uppercase tracking-wider">🏢 Info Perusahaan</h4>
                <p class="mb-1.5 hover:text-blue-600 cursor-pointer">Syarat & Ketentuan Layanan</p>
                <p class="hover:text-blue-600 cursor-pointer">Kebijakan Privasi SkyLinee</p>
            </div>
            <div>
                <h4 class="font-bold text-slate-700 mb-3 uppercase tracking-wider">🔒 Jaminan Keamanan</h4>
                <p class="text-[11px] leading-relaxed">Seluruh proses transaksi pembayaran dilindungi oleh enkripsi SSL berkekuatan tinggi serta didukung integrasi multi-bank yang sah.</p>
            </div>
        </div>
    </footer>

</body>
</html>