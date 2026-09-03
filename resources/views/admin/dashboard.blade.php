@extends('layouts.admin')

@section('title', 'Dashboard Eksekutif MIS')

@section('content')

<!-- Header Banner -->
<div class="mb-7 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900">Dashboard Eksekutif MIS</h1>
        <p class="text-xs text-slate-500 mt-1">Pangkalan Data & Tata Kelola Administrasi DPD APPSI Kabupaten Banyuasin</p>
    </div>

    <!-- 1-Baris Quick Action Buttons Sesuai Permintaan User -->
    <div class="flex items-center gap-2 overflow-x-auto pb-1 sm:pb-0">
        <a href="{{ route('admin.posts.create') }}" class="inline-flex items-center gap-2 whitespace-nowrap rounded-xl bg-emerald-700 px-4 py-2 text-xs font-bold text-white shadow-sm hover:bg-emerald-800 transition">
            <i class="fa-solid fa-pen-nib text-[11px]"></i>
            <span>Tulis Berita</span>
        </a>
        <a href="{{ route('admin.letters.create') }}" class="inline-flex items-center gap-2 whitespace-nowrap rounded-xl bg-slate-900 px-4 py-2 text-xs font-bold text-white shadow-sm hover:bg-slate-800 transition">
            <i class="fa-solid fa-paper-plane text-[11px]"></i>
            <span>Buat Surat Keluar</span>
        </a>
        <a href="{{ route('admin.meetings.create') }}" class="inline-flex items-center gap-2 whitespace-nowrap rounded-xl border border-slate-200 bg-white px-4 py-2 text-xs font-bold text-slate-700 shadow-sm hover:bg-slate-50 transition">
            <i class="fa-solid fa-calendar-plus text-[11px] text-emerald-700"></i>
            <span>Catat Notulen Rapat</span>
        </a>
        <a href="{{ route('admin.members.create') }}" class="inline-flex items-center gap-2 whitespace-nowrap rounded-xl border border-emerald-300 bg-emerald-50 px-4 py-2 text-xs font-bold text-emerald-800 hover:bg-emerald-100 transition">
            <i class="fa-solid fa-user-plus text-[11px]"></i>
            <span>Tambah Pedagang</span>
        </a>
    </div>
</div>

<!-- Metrics Cards Grid -->
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-8">
    
    <!-- 1. Total Anggota -->
    <div class="bg-white rounded-2xl p-4 border border-slate-200/80 shadow-sm">
        <div class="flex items-center justify-between text-slate-400 mb-2">
            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Anggota</span>
            <div class="h-7 w-7 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center text-xs">
                <i class="fa-solid fa-store"></i>
            </div>
        </div>
        <p class="text-2xl font-extrabold text-slate-900">{{ $stats['total_anggota'] }}</p>
        <span class="text-[11px] text-emerald-700 font-semibold">{{ $stats['anggota_aktif'] }} Pedagang Aktif</span>
    </div>

    <!-- 2. Pendaftaran Baru Online -->
    <div class="bg-white rounded-2xl p-4 border border-slate-200/80 shadow-sm">
        <div class="flex items-center justify-between text-slate-400 mb-2">
            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Pendaftar</span>
            <div class="h-7 w-7 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center text-xs">
                <i class="fa-solid fa-user-clock"></i>
            </div>
        </div>
        <p class="text-2xl font-extrabold text-slate-900">{{ $stats['pendaftaran_baru'] }}</p>
        @if($stats['pendaftaran_baru'] > 0)
            <span class="text-[10px] font-bold text-amber-600 bg-amber-50 px-1.5 py-0.5 rounded">Perlu Verifikasi</span>
        @else
            <span class="text-[11px] text-slate-400">Semua Terproses</span>
        @endif
    </div>

    <!-- 3. Berita Pasar -->
    <div class="bg-white rounded-2xl p-4 border border-slate-200/80 shadow-sm">
        <div class="flex items-center justify-between text-slate-400 mb-2">
            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Berita</span>
            <div class="h-7 w-7 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center text-xs">
                <i class="fa-solid fa-newspaper"></i>
            </div>
        </div>
        <p class="text-2xl font-extrabold text-slate-900">{{ $stats['total_berita'] }}</p>
        <span class="text-[11px] text-slate-500 font-medium">Artikel Terbit</span>
    </div>

    <!-- 4. Surat Keluar -->
    <div class="bg-white rounded-2xl p-4 border border-slate-200/80 shadow-sm">
        <div class="flex items-center justify-between text-slate-400 mb-2">
            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Surat Keluar</span>
            <div class="h-7 w-7 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center text-xs">
                <i class="fa-solid fa-envelope-open-text"></i>
            </div>
        </div>
        <p class="text-2xl font-extrabold text-slate-900">{{ $stats['total_surat_keluar'] }}</p>
        <span class="text-[11px] text-slate-500 font-medium">Ber-QR Code</span>
    </div>

    <!-- 5. Surat Masuk -->
    <div class="bg-white rounded-2xl p-4 border border-slate-200/80 shadow-sm">
        <div class="flex items-center justify-between text-slate-400 mb-2">
            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Surat Masuk</span>
            <div class="h-7 w-7 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center text-xs">
                <i class="fa-solid fa-inbox"></i>
            </div>
        </div>
        <p class="text-2xl font-extrabold text-slate-900">{{ $stats['total_surat_masuk'] }}</p>
        <span class="text-[11px] text-slate-500 font-medium">Arsip Masuk</span>
    </div>

    <!-- 6. Aspirasi / Tamu -->
    <div class="bg-white rounded-2xl p-4 border border-slate-200/80 shadow-sm">
        <div class="flex items-center justify-between text-slate-400 mb-2">
            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Aspirasi</span>
            <div class="h-7 w-7 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center text-xs">
                <i class="fa-solid fa-comments"></i>
            </div>
        </div>
        <p class="text-2xl font-extrabold text-slate-900">{{ $stats['pesan_baru'] }}</p>
        <span class="text-[11px] text-emerald-700 font-semibold">Pesan Belum Dibaca</span>
    </div>

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

@endsection
