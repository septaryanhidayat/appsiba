<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KTA APPSI - {{ $member->nama }} ({{ $member->nomor_anggota }})</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/images/appsi-logo.png') }}">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f1f5f9;
        }
        @media print {
            body {
                background: white !important;
                padding: 0 !important;
            }
            .no-print {
                display: none !important;
            }
            .kta-card {
                box-shadow: none !important;
                border: 1px solid #cbd5e1 !important;
                page-break-inside: avoid;
            }
        }
    </style>
</head>
<body class="p-6 flex flex-col items-center justify-center min-h-screen">

    <!-- Action Bar -->
    <div class="no-print mb-6 flex items-center gap-3">
        <button onclick="window.print()" class="px-5 py-2.5 rounded-xl bg-emerald-700 text-white font-bold text-xs shadow hover:bg-emerald-800 transition flex items-center gap-2">
            <i class="fa-solid fa-print"></i> Cetak Kartu Tanda Anggota (KTA)
        </button>
        <button onclick="window.close()" class="px-4 py-2.5 rounded-xl border border-slate-300 bg-white text-slate-700 font-bold text-xs hover:bg-slate-50 transition">
            Tutup
        </button>
    </div>

    <!-- KTA Card Front -->
    <div class="kta-card w-[520px] rounded-2xl overflow-hidden border-2 border-emerald-600 bg-white shadow-2xl relative">
        
        <!-- Top Green Bar -->
        <div class="bg-gradient-to-r from-emerald-800 via-emerald-700 to-emerald-900 p-4 text-white flex items-center gap-3 relative overflow-hidden">
            <div class="h-12 w-12 rounded-full overflow-hidden flex items-center justify-center p-0.5 bg-white shrink-0 border border-emerald-300 shadow">
                <img src="{{ asset('assets/images/appsi-logo.png') }}" alt="" class="h-full w-full object-contain">
            </div>
            <div>
                <span class="text-[10px] font-bold tracking-widest uppercase text-emerald-200 block">KARTU TANDA ANGGOTA RESMI</span>
                <h2 class="text-base font-extrabold leading-tight">DPD APPSI KABUPATEN BANYUASIN</h2>
                <p class="text-[9px] text-emerald-100/90 font-medium">Asosiasi Pedagang Pasar Seluruh Indonesia &bull; Prov. Sumatera Selatan</p>
            </div>
            <div class="absolute -right-6 -bottom-6 w-24 h-24 rounded-full bg-emerald-500/20 pointer-events-none"></div>
        </div>

        <!-- Card Content Body -->
        <div class="p-5 grid grid-cols-[120px_1fr] gap-4 items-center bg-gradient-to-br from-white via-emerald-50/20 to-white">
            
            <!-- Photo & NPA Badge -->
            <div class="flex flex-col items-center text-center">
                <div class="w-28 h-36 rounded-xl overflow-hidden border-2 border-emerald-500 bg-slate-100 shadow-sm">
                    <img src="{{ $member->foto_url }}" alt="{{ $member->nama }}" class="w-full h-full object-cover">
                </div>
                <span class="mt-2 text-[9px] font-mono font-bold px-2 py-0.5 rounded bg-emerald-100 text-emerald-800 border border-emerald-200">
                    {{ $member->nomor_anggota }}
                </span>
            </div>

            <!-- Details -->
            <div class="space-y-1.5 text-xs">
                <div>
                    <span class="text-[10px] uppercase font-bold text-slate-400 block">Nama Pedagang</span>
                    <span class="text-sm font-extrabold text-slate-900 leading-tight block">{{ $member->nama }}</span>
                </div>

                <div class="grid grid-cols-2 gap-2 pt-1 border-t border-slate-100">
                    <div>
                        <span class="text-[9px] uppercase font-bold text-slate-400 block">Nama Usaha / Toko</span>
                        <span class="font-bold text-emerald-900 truncate block">{{ $member->nama_usaha }}</span>
                    </div>
                    <div>
                        <span class="text-[9px] uppercase font-bold text-slate-400 block">Bentuk Usaha</span>
                        <span class="font-semibold text-slate-800 block">{{ $member->bentuk_usaha }}</span>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-2 pt-1 border-t border-slate-100">
                    <div>
                        <span class="text-[9px] uppercase font-bold text-slate-400 block">Komoditas Barang</span>
                        <span class="font-semibold text-slate-700 truncate block">{{ $member->jenis_usaha }}</span>
                    </div>
                    <div>
                        <span class="text-[9px] uppercase font-bold text-slate-400 block">Lokasi Pasar</span>
                        <span class="font-semibold text-slate-700 truncate block">{{ $member->lokasi_pasar }}</span>
                    </div>
                </div>

                <div class="pt-1 border-t border-slate-100 flex items-center justify-between text-[10px] text-slate-500">
                    <span>Berlaku s/d: <strong>2029</strong></span>
                    <span>Status: <strong class="text-emerald-700 uppercase">Terverifikasi</strong></span>
                </div>
            </div>

        </div>

        <!-- Bottom Signer Bar -->
        <div class="p-3 bg-slate-50 border-t border-slate-200 flex items-center justify-between text-xs">
            <div class="flex items-center gap-2">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ urlencode(url('/keanggotaan?q=' . $member->nomor_anggota)) }}" alt="QR" class="w-10 h-10 border border-slate-300 rounded p-0.5 bg-white">
                <span class="text-[9px] text-slate-500 leading-tight">Pindai QR untuk validasi<br>keaslian anggota APPSI</span>
            </div>

            <div class="text-right">
                <span class="text-[9px] text-slate-500 block">Ketua DPD APPSI Banyuasin</span>
                <span class="text-[11px] font-extrabold text-slate-900 block mt-3">H. Gusra Yetri, SH</span>
            </div>
        </div>

    </div>

</body>
</html>
