@extends('layouts.admin')

@section('title', 'Dashboard Eksekutif MIS')

@section('content')

<!-- Header Banner -->
<div class="mb-7 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900">Dashboard Eksekutif MIS</h1>
        <p class="text-xs text-slate-500 mt-1">Pangkalan Data & Tata Kelola Administrasi DPD APPSI Kabupaten Banyuasin</p>
    </div>

    <!-- 1-Baris Quick Action Buttons Modern -->
    <div class="flex items-center gap-2.5 overflow-x-auto pb-1 sm:pb-0">
        <a href="{{ route('admin.posts.create') }}" class="inline-flex items-center gap-2 whitespace-nowrap rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 px-4 py-2.5 text-xs font-bold text-white shadow-md shadow-emerald-700/20 hover:from-emerald-700 hover:to-teal-700 hover:shadow-lg transition">
            <i class="fa-solid fa-pen-nib text-[11px]"></i>
            <span>Tulis Berita</span>
        </a>
        <a href="{{ route('admin.letters.create') }}" class="inline-flex items-center gap-2 whitespace-nowrap rounded-xl bg-slate-900 px-4 py-2.5 text-xs font-bold text-white shadow-md hover:bg-slate-800 transition">
            <i class="fa-solid fa-paper-plane text-[11px] text-emerald-400"></i>
            <span>Buat Surat Keluar</span>
        </a>
        <a href="{{ route('admin.meetings.create') }}" class="inline-flex items-center gap-2 whitespace-nowrap rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs font-bold text-slate-700 shadow-sm hover:bg-slate-50 transition">
            <i class="fa-solid fa-calendar-plus text-[11px] text-emerald-700"></i>
            <span>Catat Notulen Rapat</span>
        </a>
        <a href="{{ route('admin.members.create') }}" class="inline-flex items-center gap-2 whitespace-nowrap rounded-xl border border-emerald-300 bg-emerald-50/80 px-4 py-2.5 text-xs font-bold text-emerald-800 hover:bg-emerald-100 transition shadow-sm">
            <i class="fa-solid fa-user-plus text-[11px]"></i>
            <span>Tambah Pedagang</span>
        </a>
    </div>
</div>

<!-- Metrics Cards Grid (Vibrant, Modern Executive Design) -->
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-8">
    
    <!-- 1. Total Anggota (Emerald Vibrant Gradient) -->
    <a href="{{ route('admin.members.index') }}" class="group relative overflow-hidden rounded-2xl p-4.5 bg-gradient-to-br from-emerald-500/15 via-teal-50/40 to-white border border-emerald-200/90 shadow-sm hover:shadow-xl hover:shadow-emerald-900/10 hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
        <div class="flex items-center justify-between mb-3">
            <span class="text-[10px] font-extrabold uppercase tracking-wider text-emerald-800">Anggota</span>
            <div class="h-8 w-8 rounded-xl bg-gradient-to-tr from-emerald-600 to-teal-500 text-white flex items-center justify-center text-xs shadow-md shadow-emerald-600/30 group-hover:scale-110 transition-transform">
                <i class="fa-solid fa-store"></i>
            </div>
        </div>
        <div>
            <p class="text-3xl font-black text-slate-900 tracking-tight mb-1">{{ $stats['total_anggota'] }}</p>
            <div class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full bg-emerald-100/90 border border-emerald-300/60 text-[10px] font-bold text-emerald-800">
                <span class="h-1.5 w-1.5 rounded-full bg-emerald-600 animate-pulse"></span>
                <span>{{ $stats['anggota_aktif'] }} Pedagang Aktif</span>
            </div>
        </div>
    </a>

    <!-- 2. Pendaftaran Baru Online (Amber Vibrant Gradient) -->
    <a href="{{ route('admin.registrations.index') }}" class="group relative overflow-hidden rounded-2xl p-4.5 bg-gradient-to-br from-amber-500/15 via-orange-50/40 to-white border border-amber-200/90 shadow-sm hover:shadow-xl hover:shadow-amber-900/10 hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
        <div class="flex items-center justify-between mb-3">
            <span class="text-[10px] font-extrabold uppercase tracking-wider text-amber-800">Pendaftar</span>
            <div class="h-8 w-8 rounded-xl bg-gradient-to-tr from-amber-500 to-orange-500 text-white flex items-center justify-center text-xs shadow-md shadow-amber-500/30 group-hover:scale-110 transition-transform">
                <i class="fa-solid fa-user-clock"></i>
            </div>
        </div>
        <div>
            <p class="text-3xl font-black text-slate-900 tracking-tight mb-1">{{ $stats['pendaftaran_baru'] }}</p>
            @if($stats['pendaftaran_baru'] > 0)
                <div class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full bg-amber-100/90 border border-amber-300/60 text-[10px] font-bold text-amber-800">
                    <span class="h-1.5 w-1.5 rounded-full bg-amber-600 animate-ping"></span>
                    <span>Perlu Verifikasi</span>
                </div>
            @else
                <div class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-slate-100 text-[10px] font-semibold text-slate-500">
                    <i class="fa-solid fa-circle-check text-[9px] text-emerald-600"></i> Semua Terproses
                </div>
            @endif
        </div>
    </a>

    <!-- 3. Berita Pasar (Royal Blue Vibrant Gradient) -->
    <a href="{{ route('admin.posts.publish') }}" class="group relative overflow-hidden rounded-2xl p-4.5 bg-gradient-to-br from-blue-500/15 via-indigo-50/40 to-white border border-blue-200/90 shadow-sm hover:shadow-xl hover:shadow-blue-900/10 hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
        <div class="flex items-center justify-between mb-3">
            <span class="text-[10px] font-extrabold uppercase tracking-wider text-blue-800">Berita</span>
            <div class="h-8 w-8 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 text-white flex items-center justify-center text-xs shadow-md shadow-blue-600/30 group-hover:scale-110 transition-transform">
                <i class="fa-solid fa-newspaper"></i>
            </div>
        </div>
        <div>
            <p class="text-3xl font-black text-slate-900 tracking-tight mb-1">{{ $stats['total_berita'] }}</p>
            <div class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full bg-blue-100/90 border border-blue-300/60 text-[10px] font-bold text-blue-800">
                <i class="fa-solid fa-globe text-[9px]"></i>
                <span>Artikel Terbit</span>
            </div>
        </div>
    </a>

    <!-- 4. Surat Keluar (Violet Vibrant Gradient) -->
    <a href="{{ route('admin.letters.index') }}" class="group relative overflow-hidden rounded-2xl p-4.5 bg-gradient-to-br from-violet-500/15 via-purple-50/40 to-white border border-violet-200/90 shadow-sm hover:shadow-xl hover:shadow-violet-900/10 hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
        <div class="flex items-center justify-between mb-3">
            <span class="text-[10px] font-extrabold uppercase tracking-wider text-violet-800">Surat Keluar</span>
            <div class="h-8 w-8 rounded-xl bg-gradient-to-tr from-violet-600 to-purple-600 text-white flex items-center justify-center text-xs shadow-md shadow-violet-600/30 group-hover:scale-110 transition-transform">
                <i class="fa-solid fa-envelope-open-text"></i>
            </div>
        </div>
        <div>
            <p class="text-3xl font-black text-slate-900 tracking-tight mb-1">{{ $stats['total_surat_keluar'] }}</p>
            <div class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full bg-violet-100/90 border border-violet-300/60 text-[10px] font-bold text-violet-800">
                <i class="fa-solid fa-qrcode text-[9px]"></i>
                <span>Ber-QR Code</span>
            </div>
        </div>
    </a>

    <!-- 5. Surat Masuk (Rose Vibrant Gradient) -->
    <a href="{{ route('admin.incoming-letters.index') }}" class="group relative overflow-hidden rounded-2xl p-4.5 bg-gradient-to-br from-rose-500/15 via-pink-50/40 to-white border border-rose-200/90 shadow-sm hover:shadow-xl hover:shadow-rose-900/10 hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
        <div class="flex items-center justify-between mb-3">
            <span class="text-[10px] font-extrabold uppercase tracking-wider text-rose-800">Surat Masuk</span>
            <div class="h-8 w-8 rounded-xl bg-gradient-to-tr from-rose-500 to-pink-600 text-white flex items-center justify-center text-xs shadow-md shadow-rose-500/30 group-hover:scale-110 transition-transform">
                <i class="fa-solid fa-inbox"></i>
            </div>
        </div>
        <div>
            <p class="text-3xl font-black text-slate-900 tracking-tight mb-1">{{ $stats['total_surat_masuk'] }}</p>
            <div class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full bg-rose-100/90 border border-rose-300/60 text-[10px] font-bold text-rose-800">
                <i class="fa-solid fa-folder-tree text-[9px]"></i>
                <span>Arsip Masuk</span>
            </div>
        </div>
    </a>

    <!-- 6. Aspirasi / Tamu (Teal & Cyan Vibrant Gradient) -->
    <a href="{{ route('admin.inbox.index') }}" class="group relative overflow-hidden rounded-2xl p-4.5 bg-gradient-to-br from-teal-500/15 via-cyan-50/40 to-white border border-teal-200/90 shadow-sm hover:shadow-xl hover:shadow-teal-900/10 hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
        <div class="flex items-center justify-between mb-3">
            <span class="text-[10px] font-extrabold uppercase tracking-wider text-teal-800">Aspirasi</span>
            <div class="h-8 w-8 rounded-xl bg-gradient-to-tr from-teal-600 to-cyan-600 text-white flex items-center justify-center text-xs shadow-md shadow-teal-600/30 group-hover:scale-110 transition-transform">
                <i class="fa-solid fa-comments"></i>
            </div>
        </div>
        <div>
            <p class="text-3xl font-black text-slate-900 tracking-tight mb-1">{{ $stats['pesan_baru'] }}</p>
            @if($stats['pesan_baru'] > 0)
                <div class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full bg-teal-100/90 border border-teal-300/60 text-[10px] font-bold text-teal-800">
                    <span class="h-1.5 w-1.5 rounded-full bg-teal-600 animate-pulse"></span>
                    <span>Pesan Belum Dibaca</span>
                </div>
            @else
                <div class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-slate-100 text-[10px] font-semibold text-slate-500">
                    <i class="fa-solid fa-check text-[9px] text-teal-600"></i> Kotak Pesan Bersih
                </div>
            @endif
        </div>
    </a>

</div>

<!-- Recent Content Tables -->
<div class="grid lg:grid-cols-2 gap-6">
    
    <!-- Recent Members -->
    <div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-sm flex flex-col justify-between">
        <div>
            <div class="p-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-store text-emerald-700 text-sm"></i>
                    <h3 class="text-sm font-bold text-slate-900">Pedagang Anggota Terbaru</h3>
                </div>
                <a href="{{ route('admin.members.index') }}" class="text-xs font-bold text-emerald-700 hover:text-emerald-800">
                    Lihat Semua &rarr;
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr>
                            <th class="p-3">Pedagang / Usaha</th>
                            <th class="p-3">Komoditas</th>
                            <th class="p-3">Lokasi Pasar</th>
                            <th class="p-3 text-center">NPA</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($recentMembers as $m)
                            <tr class="hover:bg-slate-50">
                                <td class="p-3">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-8 h-8 rounded-full overflow-hidden bg-slate-100 shrink-0 border border-slate-200">
                                            <img src="{{ $m->foto_url }}" alt="" class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <span class="font-bold text-slate-900 block">{{ $m->nama }}</span>
                                            <span class="text-[11px] text-slate-500">{{ $m->nama_usaha }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-3 text-slate-600">{{ $m->jenis_usaha }}</td>
                                <td class="p-3 text-slate-600">{{ $m->lokasi_pasar }}</td>
                                <td class="p-3 text-center font-mono font-bold text-emerald-800">{{ $m->nomor_anggota }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-6 text-center text-slate-400">Belum ada pedagang terdaftar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="p-3 bg-slate-50 border-t border-slate-100 text-right">
            <a href="{{ route('admin.members.create') }}" class="inline-flex items-center gap-1 text-xs font-bold text-emerald-700 hover:underline">
                <i class="fa-solid fa-plus text-[10px]"></i> Tambah Anggota Pedagang
            </a>
        </div>
    </div>

    <!-- Recent Online Registrations -->
    <div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-sm flex flex-col justify-between">
        <div>
            <div class="p-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-user-clock text-amber-600 text-sm"></i>
                    <h3 class="text-sm font-bold text-slate-900">Pendaftaran Pedagang Online</h3>
                </div>
                <a href="{{ route('admin.registrations.index') }}" class="text-xs font-bold text-emerald-700 hover:text-emerald-800">
                    Lihat Semua &rarr;
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr>
                            <th class="p-3">Calon Anggota</th>
                            <th class="p-3">Usaha & Pasar</th>
                            <th class="p-3">Kontak</th>
                            <th class="p-3 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($recentRegistrations as $reg)
                            <tr class="hover:bg-slate-50">
                                <td class="p-3">
                                    <span class="font-bold text-slate-900 block">{{ $reg->nama }}</span>
                                    <span class="text-[10px] text-slate-500">NIK: {{ $reg->nik }}</span>
                                </td>
                                <td class="p-3">
                                    <span class="font-medium text-slate-800 block">{{ $reg->nama_usaha }}</span>
                                    <span class="text-[10px] text-slate-500">{{ $reg->lokasi_pasar }}</span>
                                </td>
                                <td class="p-3 font-mono text-slate-600">{{ $reg->no_hp }}</td>
                                <td class="p-3 text-center">
                                    @if($reg->status === 'menunggu_verifikasi')
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800">Pending</span>
                                    @elseif($reg->status === 'disetujui')
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">Disetujui</span>
                                    @else
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-red-100 text-red-800">Ditolak</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-6 text-center text-slate-400">Belum ada antrean pendaftaran online.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="p-3 bg-slate-50 border-t border-slate-100 text-right">
            <a href="{{ route('admin.registrations.index') }}" class="inline-flex items-center gap-1 text-xs font-bold text-emerald-700 hover:underline">
                Kelola Verifikasi Pendaftaran &rarr;
            </a>
        </div>
    </div>

</div>

<!-- Outgoing Letters Section -->
<div class="mt-6 bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-sm">
    <div class="p-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
        <div class="flex items-center gap-2">
            <i class="fa-solid fa-paper-plane text-emerald-700 text-sm"></i>
            <h3 class="text-sm font-bold text-slate-900">Surat Keluar Resmi Terbit Terbaru (Ber-QR Code)</h3>
        </div>
        <a href="{{ route('admin.letters.index') }}" class="text-xs font-bold text-emerald-700 hover:text-emerald-800">
            Kelola Seluruh Surat &rarr;
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs">
            <thead>
                <tr>
                    <th class="p-3">Nomor Surat</th>
                    <th class="p-3">Tanggal</th>
                    <th class="p-3">Tujuan / Instansi</th>
                    <th class="p-3">Perihal / Keperluan</th>
                    <th class="p-3 text-center">Keabsahan QR</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($recentLetters as $lt)
                    <tr class="hover:bg-slate-50">
                        <td class="p-3 font-bold text-slate-900">{{ $lt->nomor_surat }}</td>
                        <td class="p-3 text-slate-600">{{ $lt->tanggal ? $lt->tanggal->format('d/m/Y') : '-' }}</td>
                        <td class="p-3 text-slate-800 font-medium">{{ $lt->tujuan }}</td>
                        <td class="p-3 text-slate-600 max-w-xs truncate">{{ $lt->perihal ?? $lt->keperluan }}</td>
                        <td class="p-3 text-center">
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-bold">
                                <i class="fa-solid fa-qrcode text-[9px]"></i> Valid
                            </span>
                        </td>
                        <td class="p-3 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.letters.show', $lt->id) }}" target="_blank" class="px-2 py-1 rounded bg-slate-100 text-slate-700 hover:bg-slate-200 text-[11px] font-bold">
                                    <i class="fa-solid fa-print"></i> Cetak
                                </a>
                                <a href="{{ route('letter.verify', $lt->hash_keabsahan) }}" target="_blank" class="px-2 py-1 rounded bg-emerald-50 text-emerald-700 hover:bg-emerald-100 text-[11px] font-bold">
                                    <i class="fa-solid fa-up-right-from-square"></i> Cek QR
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-6 text-center text-slate-400">Belum ada surat keluar tercatat.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-8 mb-2 flex flex-col sm:flex-row items-center justify-between text-[11px] text-slate-400 px-2 gap-2">
    <span>Pangkalan Data Terpadu DPD APPSI Kabupaten Banyuasin</span>
    <span>
        Didukung oleh <a href="https://berandadigital.net" target="_blank" rel="noopener noreferrer" class="text-slate-400 hover:text-emerald-700 transition">Beranda Teknologi Digital</a>
    </span>
</div>

@endsection
