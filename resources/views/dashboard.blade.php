<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-800 leading-tight flex items-center gap-2">
            👋 Selamat Datang, {{ Auth::user()->name }}!
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-3xl p-6 sm:p-8 text-white shadow-xl shadow-blue-200">
                <div class="max-w-xl">
                    <h3 class="text-xl font-bold mb-2">Siap untuk penerbangan berikutnya?</h3>
                    <p class="text-blue-100 text-sm mb-6">Kelola pesanan tiket pesawat Anda, lakukan check-in online, dan pantau riwayat transaksi Anda dengan mudah di sini.</p>
                    <a href="{{ route('home') }}" class="px-6 py-3 bg-white text-blue-600 font-bold rounded-xl shadow-md hover:bg-blue-50 transition inline-block text-sm">
                        ✈️ Cari Tiket Baru
                    </a>
                </div>
            </div>

            <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/40">
                <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                    🎟️ Riwayat Pemesanan Tiket Anda
                </h3>

                @if($bookings->isEmpty())
                    <div class="text-center py-12 border-2 border-dashed border-slate-200 rounded-2xl">
                        <div class="text-4xl mb-3">📭</div>
                        <p class="text-slate-600 font-semibold text-sm">Belum ada pemesanan tiket pesawat.</p>
                        <p class="text-slate-400 text-xs mt-1">Tiket yang Anda beli nanti akan otomatis muncul di halaman ini.</p>
                    </div>
                @else
                    <div class="overflow-x-auto rounded-2xl border border-slate-100">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50 text-slate-600 text-xs font-bold uppercase tracking-wider border-b border-slate-100">
                                    <th class="p-4">Kode Booking</th>
                                    <th class="p-4">No. Pesawat</th>
                                    <th class="p-4">Rute Penerbangan</th>
                                    <th class="p-4">Waktu Berangkat</th>
                                    <th class="p-4">Total Bayar</th>
                                    <th class="p-4 text-center">Status</th>
                                    <th class="p-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50 text-slate-700 text-sm">
                                @foreach($bookings as $booking)
                                    <tr class="hover:bg-slate-50/50 transition">
                                        <td class="p-4 font-mono font-bold text-blue-600">{{ $booking->booking_code }}</td>
                                        <td class="p-4 font-semibold text-slate-800">{{ $booking->flight->flight_number }}</td>
                                        <td class="p-4">
                                            <div class="font-bold text-slate-900">
                                                {{ $booking->flight->departureAirport->city }} ({{ $booking->flight->departureAirport->code }})
                                            </div>
                                            <div class="text-xs text-slate-400 my-0.5">➔ menuju ke</div>
                                            <div class="font-bold text-slate-900">
                                                {{ $booking->flight->arrivalAirport->city }} ({{ $booking->flight->arrivalAirport->code }})
                                            </div>
                                        </td>
                                        <td class="p-4 text-slate-600 font-medium">
                                            {{ \Carbon\Carbon::parse($booking->flight->departure_time)->format('d M Y - H:i') }} WIB
                                        </td>
                                        <td class="p-4 font-extrabold text-slate-900">
                                            Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                        </td>
                                        <td class="p-4 text-center">
                                            <span class="px-3 py-1 text-xs font-bold uppercase rounded-full bg-emerald-50 text-emerald-600 border border-emerald-100">
                                                {{ $booking->status ?? 'SUCCESS' }}
                                            </span>
                                        </td>
                                        <td class="p-4 text-center">
                                            <button 
                                                onclick="bukaModalQR('{{ $booking->booking_code }}', '{{ $booking->flight->flight_number }}', '{{ $booking->flight->departureAirport->city }}', '{{ $booking->flight->arrivalAirport->city }}')"
                                                class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-900 hover:bg-blue-600 text-white text-xs font-bold rounded-lg shadow-sm transition-all duration-150 transform hover:scale-105"
                                            >
                                                📷 Cetak QR
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div id="modalQR" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm hidden items-center justify-center z-50 p-4 transition-all opacity-0">
        <div class="bg-white rounded-3xl max-w-sm w-full overflow-hidden shadow-2xl border border-slate-100 transform scale-95 transition-all duration-300">
            
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 p-6 text-white text-center relative">
                <span class="text-2xl">✈️</span>
                <h4 class="font-extrabold text-lg mt-1 tracking-wide">BOARDING PASS</h4>
                <p class="text-blue-200 text-xs font-mono tracking-widest mt-0.5" id="modalFlightNum">SL-000</p>
                
                <button onclick="tutupModalQR()" class="absolute top-4 right-4 text-white/70 hover:text-white bg-white/10 hover:bg-white/20 w-7 h-7 rounded-full text-sm font-bold transition">✕</button>
            </div>

            <div class="p-6 space-y-6 text-center">
                <div class="flex items-center justify-between px-4">
                    <div>
                        <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">Asal</p>
                        <p class="font-black text-slate-800 text-lg" id="modalAsal">CITY</p>
                    </div>
                    <div class="text-slate-300 font-bold text-lg animate-pulse">➔</div>
                    <div>
                        <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">Tujuan</p>
                        <p class="font-black text-slate-800 text-lg" id="modalTujuan">CITY</p>
                    </div>
                </div>

                <div class="flex items-center my-2">
                    <div class="w-4 h-4 bg-slate-50 rounded-full -ml-8 border-r border-slate-100"></div>
                    <div class="w-full border-t border-dashed border-slate-200"></div>
                    <div class="w-4 h-4 bg-slate-50 rounded-full -mr-8 border-l border-slate-100"></div>
                </div>

                <div class="flex flex-col items-center justify-center space-y-2">
                    <div class="p-3 bg-slate-50 rounded-2xl border border-slate-100 shadow-inner">
                        <img id="gambarQR" src="" alt="QR Code Pesanan" class="w-44 h-44 mx-auto rounded-lg">
                    </div>
                    <p class="text-xs font-mono font-bold text-blue-600 bg-blue-50 px-3 py-1 rounded-full inline-block mt-2" id="modalBookingCode">BK-XXXXX</p>
                </div>

                <p class="text-[11px] text-slate-400 leading-relaxed font-medium">Scan QR Code di atas menggunakan kamera smartphone atau scanner petugas untuk melakukan verifikasi boarding pass fisik Anda.</p>
            </div>

            <div class="bg-slate-50 p-4 border-t border-slate-100 flex gap-2">
                <button onclick="window.print()" class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl text-xs shadow-md transition">
                    🖨️ Cetak Tiket
                </button>
            </div>
        </div>
    </div>

    <script>
        function bukaModalQR(code, flight, asal, tujuan) {
            const modal = document.getElementById('modalQR');
            
            document.getElementById('modalBookingCode').innerText = code;
            document.getElementById('modalFlightNum').innerText = flight;
            document.getElementById('modalAsal').innerText = asal;
            document.getElementById('modalTujuan').innerText = tujuan;
            
            // LINK GENERATOR BARU: Sangat stabil untuk localhost, gambar dijamin langsung muncul!
            document.getElementById('gambarQR').src = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${encodeURIComponent(code)}`;
            
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                modal.querySelector('.transform').classList.remove('scale-95');
            }, 10);
        }

        function tutupModalQR() {
            const modal = document.getElementById('modalQR');
            modal.classList.add('opacity-0');
            modal.querySelector('.transform').classList.add('scale-95');
            setTimeout(() => {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }, 300);
        }
    </script>
</x-app-layout>