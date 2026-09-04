<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekapitulasi Data Pedagang Pasar - DPD APPSI Banyuasin</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/images/appsi-logo.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        @media print {
            .no-print { display: none !important; }
            body { background: white !important; font-size: 10pt; }
            .print-container { box-shadow: none !important; border: none !important; padding: 0 !important; width: 100% !important; max-width: 100% !important; }
            table { page-break-inside: auto; }
            tr { page-break-inside: avoid; page-break-after: auto; }
            thead { display: table-header-group; }
            tfoot { display: table-footer-group; }
        }
    </style>
</head>
<body class="bg-slate-100 font-sans text-slate-900 p-4 sm:p-8 min-h-screen">

    <!-- Action Bar (Hidden on print) -->
    <div class="no-print mx-auto max-w-5xl mb-6 flex flex-wrap items-center justify-between gap-3 bg-white p-4 rounded-2xl border border-slate-200 shadow-sm">
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.members.index') }}" class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-xs font-bold text-slate-700 transition">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke MIS
            </a>
            <span class="text-xs text-slate-400">|</span>
            <span class="text-xs font-bold text-slate-700">Total: {{ $members->count() }} Pedagang Terdaftar</span>
        </div>
        <div class="flex items-center gap-2">
            <button onclick="window.print()" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold transition shadow-sm">
                <i class="fa-solid fa-print"></i>
                <span>Cetak / Simpan PDF</span>
            </button>
        </div>
    </div>

    <!-- Printable Paper Sheet -->
    <div class="print-container mx-auto max-w-5xl bg-white p-8 sm:p-12 rounded-3xl border border-slate-200 shadow-lg">
        
        <!-- Official KOP Header -->
        <div class="flex items-center gap-5 border-b-4 border-double border-slate-800 pb-4 mb-6">
            <div class="w-20 h-20 shrink-0">
                <img src="{{ asset('assets/images/appsi-logo.png') }}" alt="Logo APPSI" class="w-full h-full object-contain">
            </div>
            <div class="flex-1 text-center pr-10">
                <h3 class="text-sm font-bold uppercase tracking-wider text-slate-700">DEWAN PIMPINAN DAERAH (DPD)</h3>
                <h1 class="text-xl sm:text-2xl font-black text-emerald-800 uppercase tracking-tight">ASOSIASI PEDAGANG PASAR SELURUH INDONESIA</h1>
                <h2 class="text-base font-extrabold text-slate-900 uppercase tracking-wide">KABUPATEN BANYUASIN</h2>
                <p class="text-[10px] sm:text-[11px] text-slate-600 mt-1 leading-tight">
                    {{ $settings['alamat'] ?? 'Jalan Merdeka, Depan Pasar Baru Kelurahan Pangkalan Balai - Kecamatan Banyuasin III, Kabupaten Banyuasin, Sumatera Selatan' }}
                    <br>
                    Telepon: {{ $settings['telepon'] ?? '0811 618 808' }} &bull; Email: {{ $settings['email'] ?? 'appsi.banyuasin@gmail.com' }} &bull; Website: appsiba.or.id
                </p>
            </div>
        </div>

        <!-- Document Title -->
        <div class="text-center my-6">
            <h2 class="text-base sm:text-lg font-black uppercase text-slate-900 underline tracking-wide">
                REKAPITULASI DATA PEDAGANG PASAR ANGGOTA RESMI
            </h2>
            <p class="text-xs text-slate-500 mt-1">
                Data per {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }} &bull; DPD APPSI Kabupaten Banyuasin
            </p>
        </div>

        <!-- Table Data -->
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-slate-300 text-xs">
                <thead>
                    <tr class="bg-emerald-800 text-white">
                        <th class="border border-slate-300 p-2 text-center w-10">No</th>
                        <th class="border border-slate-300 p-2 text-center w-28">NPA APPSI</th>
                        <th class="border border-slate-300 p-2 text-left">Nama Pedagang</th>
                        <th class="border border-slate-300 p-2 text-left">Nama Lapak / Toko</th>
                        <th class="border border-slate-300 p-2 text-left">Komoditas Usaha</th>
                        <th class="border border-slate-300 p-2 text-left">Lokasi Pasar</th>
                        <th class="border border-slate-300 p-2 text-center">Blok / Los</th>
                        <th class="border border-slate-300 p-2 text-center">No. HP</th>
                        <th class="border border-slate-300 p-2 text-center w-16">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse($members as $index => $m)
                        <tr class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-slate-50' }}">
                            <td class="border border-slate-300 p-2 text-center">{{ $index + 1 }}</td>
                            <td class="border border-slate-300 p-2 text-center font-mono font-bold text-emerald-800">{{ $m->nomor_anggota }}</td>
                            <td class="border border-slate-300 p-2 font-bold text-slate-900">{{ $m->nama }}</td>
                            <td class="border border-slate-300 p-2 text-slate-700">{{ $m->nama_usaha }}</td>
                            <td class="border border-slate-300 p-2 text-slate-600">{{ $m->jenis_usaha }}</td>
                            <td class="border border-slate-300 p-2 text-slate-800 font-semibold">{{ $m->lokasi_pasar }}</td>
                            <td class="border border-slate-300 p-2 text-center text-slate-600">{{ $m->blok_nomor ?? '-' }}</td>
                            <td class="border border-slate-300 p-2 text-center text-slate-600 font-mono text-[11px]">{{ $m->no_hp ?? '-' }}</td>
                            <td class="border border-slate-300 p-2 text-center">
                                <span class="uppercase text-[10px] font-bold {{ $m->status === 'aktif' ? 'text-emerald-700' : 'text-amber-700' }}">
                                    {{ $m->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="p-4 text-center text-slate-400 italic">Belum ada data pedagang yang memenuhi kriteria filter.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Signatures Block -->
        <div class="mt-12 pt-6 grid grid-cols-2 text-center text-xs">
            <div>
                <p class="text-slate-500">Mengetahui,</p>
                <p class="font-bold text-slate-900 mt-1">Ketua DPD APPSI Banyuasin</p>
                <div class="h-20"></div>
                <p class="font-extrabold text-slate-900 underline">{{ $settings['nama_ketua'] ?? 'H. Gusra Yetri, SH' }}</p>
                <p class="text-[10px] text-slate-500">NPA DPD: DPD-BA-01.0001</p>
            </div>
            <div>
                <p class="text-slate-500">Pangkalan Balai, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                <p class="font-bold text-slate-900 mt-1">Sekretaris DPD APPSI Banyuasin</p>
                <div class="h-20"></div>
                <p class="font-extrabold text-slate-900 underline">{{ $settings['nama_sekretaris'] ?? 'M. Rian Pratama, S.E.' }}</p>
                <p class="text-[10px] text-slate-500">NPA DPD: DPD-BA-01.0002</p>
            </div>
        </div>

    </div>

</body>
</html>
