@extends('layouts.admin')

@section('title', 'Dashboard Eksekutif MIS')

@section('content')

<!-- Header Banner & Quick Actions -->
<div class="mb-6 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
    <div>
        <div class="flex items-center gap-2">
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">Dashboard Eksekutif MIS</h1>
            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                Live Data
            </span>
        </div>
        <p class="text-xs text-slate-500 mt-1">Pangkalan Data & Tata Kelola Administrasi DPD APPSI Kabupaten Banyuasin</p>
    </div>

    <!-- Quick Action Buttons: 2x2 Grid di Mobile, 1 Baris di Layar Besar -->
    <div class="grid grid-cols-2 sm:flex sm:items-center gap-2 sm:gap-2.5">
        <a href="{{ route('admin.posts.create') }}" class="flex items-center justify-center gap-2 py-2.5 px-3 rounded-xl bg-emerald-700 text-white font-bold text-xs shadow-sm hover:bg-emerald-800 transition">
            <i class="fa-solid fa-pen-nib text-[10px]"></i>
            <span>Tulis Berita</span>
        </a>
        <a href="{{ route('admin.letters.create') }}" class="flex items-center justify-center gap-2 py-2.5 px-3 rounded-xl bg-slate-900 text-white font-bold text-xs shadow-sm hover:bg-slate-800 transition">
            <i class="fa-solid fa-paper-plane text-[10px] text-emerald-400"></i>
            <span>Buat Surat</span>
        </a>
        <a href="{{ route('admin.meetings.create') }}" class="flex items-center justify-center gap-2 py-2.5 px-3 rounded-xl bg-white border border-slate-200 text-slate-700 font-bold text-xs shadow-sm hover:bg-slate-50 transition">
            <i class="fa-solid fa-calendar-plus text-[10px] text-emerald-700"></i>
            <span>Catat Rapat</span>
        </a>
        <a href="{{ route('admin.members.create') }}" class="flex items-center justify-center gap-2 py-2.5 px-3 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 font-bold text-xs shadow-sm hover:bg-emerald-100 transition">
            <i class="fa-solid fa-user-plus text-[10px]"></i>
            <span>Tambah Pedagang</span>
        </a>
    </div>
</div>

<!-- Metrics Cards Grid: Desain Eksekutif Modern & Bersih (Anti Bertumpuk di Mobile) -->
<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 sm:gap-4 mb-7">
    
    <!-- 1. Total Anggota Pedagang -->
    <a href="{{ route('admin.members.index') }}" class="group bg-white rounded-2xl p-3.5 sm:p-4 border border-slate-200/80 shadow-[0_2px_8px_rgba(15,23,42,0.03)] hover:border-emerald-500 hover:shadow-md transition-all flex flex-col justify-between">
        <div class="flex items-center justify-between gap-2">
            <span class="text-[10px] font-extrabold uppercase tracking-wider text-slate-500">Anggota</span>
            <div class="h-7 w-7 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center text-xs shrink-0 group-hover:bg-emerald-700 group-hover:text-white transition-colors">
                <i class="fa-solid fa-store"></i>
            </div>
        </div>
        <div class="my-2">
            <span class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight leading-none">{{ $stats['total_anggota'] }}</span>
        </div>
        <div class="text-[11px] font-semibold text-emerald-700 truncate">
            {{ $stats['anggota_aktif'] }} Pedagang Aktif
        </div>
    </a>

    <!-- 2. Pendaftaran Online Baru -->
    <a href="{{ route('admin.registrations.index') }}" class="group bg-white rounded-2xl p-3.5 sm:p-4 border border-slate-200/80 shadow-[0_2px_8px_rgba(15,23,42,0.03)] hover:border-amber-500 hover:shadow-md transition-all flex flex-col justify-between">
        <div class="flex items-center justify-between gap-2">
            <span class="text-[10px] font-extrabold uppercase tracking-wider text-slate-500">Pendaftar</span>
            <div class="h-7 w-7 rounded-lg bg-amber-50 text-amber-700 flex items-center justify-center text-xs shrink-0 group-hover:bg-amber-500 group-hover:text-white transition-colors">
                <i class="fa-solid fa-user-clock"></i>
            </div>
        </div>
        <div class="my-2">
            <span class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight leading-none">{{ $stats['pendaftaran_baru'] }}</span>
        </div>
        <div class="text-[11px] font-semibold {{ $stats['pendaftaran_baru'] > 0 ? 'text-amber-600 font-bold' : 'text-slate-400' }} truncate">
            {{ $stats['pendaftaran_baru'] > 0 ? $stats['pendaftaran_baru'] . ' Perlu Diproses' : 'Semua Terverifikasi' }}
        </div>
    </a>

    <!-- 3. Berita & Kabar Pasar -->
    <a href="{{ route('admin.posts.publish') }}" class="group bg-white rounded-2xl p-3.5 sm:p-4 border border-slate-200/80 shadow-[0_2px_8px_rgba(15,23,42,0.03)] hover:border-blue-500 hover:shadow-md transition-all flex flex-col justify-between">
        <div class="flex items-center justify-between gap-2">
            <span class="text-[10px] font-extrabold uppercase tracking-wider text-slate-500">Berita</span>
            <div class="h-7 w-7 rounded-lg bg-blue-50 text-blue-700 flex items-center justify-center text-xs shrink-0 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                <i class="fa-solid fa-newspaper"></i>
            </div>
        </div>
        <div class="my-2">
            <span class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight leading-none">{{ $stats['total_berita'] }}</span>
        </div>
        <div class="text-[11px] font-semibold text-blue-700 truncate">
            Artikel Terbit
        </div>
    </a>

    <!-- 4. Surat Keluar Ber-QR Code -->
    <a href="{{ route('admin.letters.index') }}" class="group bg-white rounded-2xl p-3.5 sm:p-4 border border-slate-200/80 shadow-[0_2px_8px_rgba(15,23,42,0.03)] hover:border-violet-500 hover:shadow-md transition-all flex flex-col justify-between">
        <div class="flex items-center justify-between gap-2">
            <span class="text-[10px] font-extrabold uppercase tracking-wider text-slate-500">Surat Keluar</span>
            <div class="h-7 w-7 rounded-lg bg-violet-50 text-violet-700 flex items-center justify-center text-xs shrink-0 group-hover:bg-violet-600 group-hover:text-white transition-colors">
                <i class="fa-solid fa-envelope-open-text"></i>
            </div>
        </div>
        <div class="my-2">
            <span class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight leading-none">{{ $stats['total_surat_keluar'] }}</span>
        </div>
        <div class="text-[11px] font-semibold text-violet-700 truncate">
            Ber-QR Code
        </div>
    </a>

    <!-- 5. Surat Masuk -->
    <a href="{{ route('admin.incoming-letters.index') }}" class="group bg-white rounded-2xl p-3.5 sm:p-4 border border-slate-200/80 shadow-[0_2px_8px_rgba(15,23,42,0.03)] hover:border-rose-500 hover:shadow-md transition-all flex flex-col justify-between">
        <div class="flex items-center justify-between gap-2">
            <span class="text-[10px] font-extrabold uppercase tracking-wider text-slate-500">Surat Masuk</span>
            <div class="h-7 w-7 rounded-lg bg-rose-50 text-rose-700 flex items-center justify-center text-xs shrink-0 group-hover:bg-rose-600 group-hover:text-white transition-colors">
                <i class="fa-solid fa-inbox"></i>
            </div>
        </div>
        <div class="my-2">
            <span class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight leading-none">{{ $stats['total_surat_masuk'] }}</span>
        </div>
        <div class="text-[11px] font-semibold text-slate-600 truncate">
            Total Arsip Masuk
        </div>
    </a>

    <!-- 6. Aspirasi & Pesan Masuk -->
    <a href="{{ route('admin.inbox.index') }}" class="group bg-white rounded-2xl p-3.5 sm:p-4 border border-slate-200/80 shadow-[0_2px_8px_rgba(15,23,42,0.03)] hover:border-teal-500 hover:shadow-md transition-all flex flex-col justify-between">
        <div class="flex items-center justify-between gap-2">
            <span class="text-[10px] font-extrabold uppercase tracking-wider text-slate-500">Aspirasi</span>
            <div class="h-7 w-7 rounded-lg bg-teal-50 text-teal-700 flex items-center justify-center text-xs shrink-0 group-hover:bg-teal-600 group-hover:text-white transition-colors">
                <i class="fa-solid fa-comments"></i>
            </div>
        </div>
        <div class="my-2">
            <span class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight leading-none">{{ $stats['pesan_baru'] }}</span>
        </div>
        <div class="text-[11px] font-semibold {{ $stats['pesan_baru'] > 0 ? 'text-teal-700 font-bold' : 'text-slate-400' }} truncate">
            {{ $stats['pesan_baru'] > 0 ? $stats['pesan_baru'] . ' Pesan Baru' : 'Kotak Bersih' }}
        </div>
    </a>

</div>

<!-- Recent Content Tables (Rapi & Responsif di Seluler) -->
<div class="grid lg:grid-cols-2 gap-5 sm:gap-6 mb-6">
    
    <!-- Recent Members Table -->
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
                <table class="w-full text-left text-xs min-w-[480px]">
                    <thead>
                        <tr class="bg-slate-50/50 text-slate-500 border-b border-slate-100">
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
                                        <div class="min-w-0">
                                            <span class="font-bold text-slate-900 block truncate">{{ $m->nama }}</span>
                                            <span class="text-[11px] text-slate-500 block truncate">{{ $m->nama_usaha }}</span>
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

    <!-- Recent Online Registrations Table -->
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
                <table class="w-full text-left text-xs min-w-[480px]">
                    <thead>
                        <tr class="bg-slate-50/50 text-slate-500 border-b border-slate-100">
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
                                    <span class="font-bold text-slate-900 block truncate">{{ $reg->nama }}</span>
                                    <span class="text-[10px] text-slate-500">NIK: {{ $reg->nik }}</span>
                                </td>
                                <td class="p-3">
                                    <span class="font-medium text-slate-800 block truncate">{{ $reg->nama_usaha }}</span>
                                    <span class="text-[10px] text-slate-500 block truncate">{{ $reg->lokasi_pasar }}</span>
                                </td>
                                <td class="p-3 font-mono text-slate-600 whitespace-nowrap">{{ $reg->no_hp }}</td>
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

<!-- Outgoing Letters Section (Responsif, Tabel Bebas Tumpang Tindih) -->
<div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-sm">
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
        <table class="w-full text-left text-xs min-w-[620px]">
            <thead>
                <tr class="bg-slate-50/50 text-slate-500 border-b border-slate-100">
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
                        <td class="p-3 font-bold text-slate-900 font-mono whitespace-nowrap">{{ $lt->nomor_surat }}</td>
                        <td class="p-3 text-slate-600 whitespace-nowrap">{{ $lt->tanggal ? $lt->tanggal->format('d/m/Y') : '-' }}</td>
                        <td class="p-3 text-slate-800 font-medium truncate max-w-[180px]">{{ $lt->tujuan }}</td>
                        <td class="p-3 text-slate-600 truncate max-w-[220px]">{{ $lt->perihal ?? $lt->keperluan }}</td>
                        <td class="p-3 text-center">
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-bold">
                                <i class="fa-solid fa-qrcode text-[9px]"></i> Valid
                            </span>
                        </td>
                        <td class="p-3 text-center whitespace-nowrap">
                            <div class="flex items-center justify-center gap-1.5">
                                <a href="{{ route('admin.letters.show', $lt->id) }}" target="_blank" class="px-2 py-1 rounded-lg bg-emerald-50 text-emerald-700 hover:bg-emerald-100 text-[11px] font-bold">
                                    <i class="fa-solid fa-print"></i> Cetak
                                </a>
                                <a href="{{ route('admin.letters.edit', $lt->id) }}" class="px-2 py-1 rounded-lg bg-blue-50 text-blue-700 hover:bg-blue-100 text-[11px] font-bold">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </a>
                                <a href="{{ route('letter.verify', $lt->hash_keabsahan) }}" target="_blank" class="px-2 py-1 rounded-lg bg-slate-100 text-slate-700 hover:bg-slate-200 text-[11px] font-bold">
                                    <i class="fa-solid fa-up-right-from-square"></i> QR
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

<!-- Watermark Ringkas & Elegan (Sesuai Permintaan) -->
<div class="mt-8 mb-2 flex flex-col sm:flex-row items-center justify-between text-[11px] text-slate-400 px-2 gap-2">
    <span>Pangkalan Data Terpadu DPD APPSI Kabupaten Banyuasin</span>
    <span>
        <a href="https://berandadigital.net" target="_blank" rel="noopener noreferrer" class="text-slate-400 hover:text-emerald-700 transition">Beranda Teknologi Digital</a>
    </span>
</div>

@endsection
