@extends('layouts.admin')

@section('title', 'Data Pedagang Anggota APPSI')

@section('content')

<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900">Data Pedagang Pasar Anggota</h1>
        <p class="text-xs text-slate-500 mt-1">Direktori & Pangkalan Data Pedagang DPD APPSI Kabupaten Banyuasin</p>
    </div>
    <div class="flex flex-wrap items-center gap-2">
        <!-- Tombol Cepat Pengaturan Visibilitas List Anggota di Web Publik -->
        <form action="{{ route('admin.members.toggle-visibility') }}" method="POST" class="inline">
            @csrf
            @if(($webSetting['tampilkan_daftar_anggota'] ?? '1') == '1')
                <button type="submit" class="inline-flex items-center gap-1.5 rounded-xl border border-emerald-300 bg-emerald-50 px-3.5 py-2.5 text-xs font-bold text-emerald-800 hover:bg-emerald-100 transition shadow-sm" title="Daftar anggota saat ini TAMPIL di website publik. Klik untuk menyembunyikan.">
                    <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>List Web: Tampil</span>
                    <i class="fa-solid fa-eye text-emerald-600 text-[11px]"></i>
                </button>
            @else
                <button type="submit" class="inline-flex items-center gap-1.5 rounded-xl border border-amber-300 bg-amber-50 px-3.5 py-2.5 text-xs font-bold text-amber-800 hover:bg-amber-100 transition shadow-sm" title="Daftar anggota saat ini DISEMBUNYIKAN dari website publik. Klik untuk menampilkan.">
                    <span class="h-2 w-2 rounded-full bg-amber-500"></span>
                    <span>List Web: Disembunyikan</span>
                    <i class="fa-solid fa-eye-slash text-amber-600 text-[11px]"></i>
                </button>
            @endif
        </form>

        <a href="{{ route('admin.members.rekap', request()->all()) }}" target="_blank" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs font-bold text-slate-700 shadow-sm hover:bg-slate-50 transition">
            <i class="fa-solid fa-print text-xs text-emerald-700"></i>
            <span>Cetak Rekap Data</span>
        </a>
        <a href="{{ route('admin.members.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-emerald-700 px-4 py-2.5 text-xs font-bold text-white shadow-sm hover:bg-emerald-800 transition">
            <i class="fa-solid fa-plus text-xs"></i>
            <span>Tambah Pedagang Baru</span>
        </a>
    </div>
</div>

<!-- Filter Bar -->
<div class="bg-white rounded-2xl border border-slate-200/80 p-4 mb-6 shadow-sm">
    <form action="{{ route('admin.members.index') }}" method="GET" class="grid sm:grid-cols-2 lg:grid-cols-4 gap-3">
        <div>
            <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1">Komoditas / Jenis Usaha</label>
            <select name="jenis_usaha" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs focus:border-emerald-600 focus:outline-none bg-slate-50">
                <option value="">-- Semua Komoditas --</option>
                @foreach($commodities as $com)
                    <option value="{{ $com }}" {{ request('jenis_usaha') == $com ? 'selected' : '' }}>{{ $com }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1">Lokasi Pasar</label>
            <select name="lokasi_pasar" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs focus:border-emerald-600 focus:outline-none bg-slate-50">
                <option value="">-- Semua Pasar --</option>
                @foreach($markets as $mkt)
                    <option value="{{ $mkt }}" {{ request('lokasi_pasar') == $mkt ? 'selected' : '' }}>{{ $mkt }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1">Cari Pedagang / NPA</label>
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Nama, Toko, NIK, NPA..." class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs focus:border-emerald-600 focus:outline-none bg-slate-50">
        </div>

        <div class="flex items-end gap-2">
            <button type="submit" class="flex-1 rounded-xl bg-emerald-700 py-2.5 text-xs font-bold text-white hover:bg-emerald-800 transition">
                <i class="fa-solid fa-filter mr-1"></i> Filter
            </button>
            <a href="{{ route('admin.members.index') }}" class="rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-xs font-bold text-slate-600 hover:bg-slate-100 transition">
                Reset
            </a>
        </div>
    </form>
</div>

<!-- Data Table -->
<div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs">
            <thead>
                <tr>
                    <th class="p-3.5">Pedagang & Foto</th>
                    <th class="p-3.5">Nama Toko & Bentuk</th>
                    <th class="p-3.5">Komoditas Usaha</th>
                    <th class="p-3.5">Lokasi Pasar</th>
                    <th class="p-3.5 text-center">NPA APPSI</th>
                    <th class="p-3.5 text-center">Status</th>
                    <th class="p-3.5 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($members as $m)
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="p-3.5">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full overflow-hidden bg-slate-100 shrink-0 border border-slate-200">
                                    <img src="{{ $m->foto_url }}" alt="{{ $m->nama }}" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <span class="font-bold text-slate-900 block text-xs">{{ $m->nama }}</span>
                                    <span class="text-[10px] text-slate-400 font-mono">NIK: {{ $m->nik ?? '-' }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="p-3.5">
                            <span class="font-semibold text-slate-800 block">{{ $m->nama_usaha }}</span>
                            <span class="text-[10px] text-slate-500">Bentuk: {{ $m->bentuk_usaha }}</span>
                        </td>
                        <td class="p-3.5 text-slate-700 font-medium">{{ $m->jenis_usaha }}</td>
                        <td class="p-3.5">
                            <span class="text-slate-800 font-medium block">{{ $m->lokasi_pasar }}</span>
                            <span class="text-[10px] text-slate-500">{{ $m->blok_nomor ?? '-' }}</span>
                        </td>
                        <td class="p-3.5 text-center font-mono font-bold text-emerald-800">
                            {{ $m->nomor_anggota }}
                        </td>
                        <td class="p-3.5 text-center">
                            @if($m->status === 'aktif')
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">Aktif</span>
                            @else
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600">{{ ucfirst($m->status) }}</span>
                            @endif
                        </td>
                        <td class="p-3.5 text-center">
                            <div class="flex items-center justify-center gap-1.5">
                                <a href="{{ route('admin.members.kta', $m->id) }}" target="_blank" class="h-8 w-8 rounded-lg bg-emerald-50 text-emerald-700 hover:bg-emerald-100 flex items-center justify-center text-xs transition" title="Cetak KTA Digital">
                                    <i class="fa-solid fa-id-badge"></i>
                                </a>
                                <a href="{{ route('admin.members.edit', $m->id) }}" class="h-8 w-8 rounded-lg bg-blue-50 text-blue-700 hover:bg-blue-100 flex items-center justify-center text-xs transition" title="Edit Pedagang">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('admin.members.destroy', $m->id) }}" method="POST" onsubmit="return confirmDelete(this, 'Hapus data pedagang {{ addslashes($m->nama) }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="h-8 w-8 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 flex items-center justify-center text-xs transition" title="Hapus">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="p-8 text-center text-slate-400">
                            Tidak ada data pedagang yang sesuai filter.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-4 border-t border-slate-100">
        {{ $members->links() }}
    </div>
</div>

@endsection
