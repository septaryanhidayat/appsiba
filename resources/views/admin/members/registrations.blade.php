@extends('layouts.admin')

@section('title', 'Pendaftaran Pedagang Online')

@section('content')

<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900">Antrean Pendaftaran Pedagang Online</h1>
        <p class="text-xs text-slate-500 mt-1">Verifikasi permohonan keanggotaan baru yang diajukan melalui portal web appsiba.or.id</p>
    </div>
    
    <!-- Filter Status -->
    <div class="flex items-center gap-2">
        <a href="{{ route('admin.registrations.index') }}" class="px-3 py-1.5 rounded-xl text-xs font-bold transition {{ !request('status') ? 'bg-emerald-700 text-white shadow' : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-50' }}">
            Semua
        </a>
        <a href="{{ route('admin.registrations.index', ['status' => 'menunggu_verifikasi']) }}" class="px-3 py-1.5 rounded-xl text-xs font-bold transition {{ request('status') === 'menunggu_verifikasi' ? 'bg-amber-600 text-white shadow' : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-50' }}">
            Menunggu
        </a>
        <a href="{{ route('admin.registrations.index', ['status' => 'disetujui']) }}" class="px-3 py-1.5 rounded-xl text-xs font-bold transition {{ request('status') === 'disetujui' ? 'bg-emerald-700 text-white shadow' : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-50' }}">
            Disetujui
        </a>
        <a href="{{ route('admin.registrations.index', ['status' => 'ditolak']) }}" class="px-3 py-1.5 rounded-xl text-xs font-bold transition {{ request('status') === 'ditolak' ? 'bg-red-600 text-white shadow' : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-50' }}">
            Ditolak
        </a>
    </div>
</div>

<div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs">
            <thead>
                <tr>
                    <th class="p-3.5">Tanggal Daftar</th>
                    <th class="p-3.5">Calon Pedagang</th>
                    <th class="p-3.5">Usaha & Komoditas</th>
                    <th class="p-3.5">Lokasi Pasar</th>
                    <th class="p-3.5">No. WhatsApp</th>
                    <th class="p-3.5 text-center">Status</th>
                    <th class="p-3.5 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($registrations as $reg)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="p-3.5 text-slate-500 whitespace-nowrap">
                            {{ $reg->created_at ? $reg->created_at->translatedFormat('d M Y H:i') : '-' }}
                        </td>
                        <td class="p-3.5">
                            <span class="font-bold text-slate-900 block">{{ $reg->nama }}</span>
                            <span class="text-[10px] text-slate-400 font-mono">NIK: {{ $reg->nik }}</span>
                        </td>
                        <td class="p-3.5">
                            <span class="font-semibold text-slate-800 block">{{ $reg->nama_usaha }}</span>
                            <span class="text-[10px] text-slate-500">{{ $reg->jenis_usaha }} ({{ $reg->bentuk_usaha }})</span>
                        </td>
                        <td class="p-3.5 text-slate-700">{{ $reg->lokasi_pasar }}</td>
                        <td class="p-3.5 font-mono text-slate-700">{{ $reg->no_hp }}</td>
                        <td class="p-3.5 text-center">
                            @if($reg->status === 'menunggu_verifikasi')
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800">
                                    <i class="fa-regular fa-clock mr-1"></i> Menunggu
                                </span>
                            @elseif($reg->status === 'disetujui')
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                    <i class="fa-solid fa-check mr-1"></i> Disetujui
                                </span>
                            @else
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-red-100 text-red-800">
                                    <i class="fa-solid fa-xmark mr-1"></i> Ditolak
                                </span>
                            @endif
                        </td>
                        <td class="p-3.5 text-center">
                            <div class="flex items-center justify-center gap-1.5">
                                <a href="{{ route('admin.registrations.show', $reg->id) }}" class="px-3 py-1.5 rounded-lg bg-emerald-700 text-white font-bold text-[11px] hover:bg-emerald-800 transition shadow-sm">
                                    Periksa &rarr;
                                </a>
                                <form action="{{ route('admin.registrations.destroy', $reg->id) }}" method="POST" onsubmit="return confirmDelete(this, 'Hapus rekaman pendaftaran ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="h-8 w-8 rounded-lg bg-slate-100 text-slate-500 hover:bg-red-50 hover:text-red-600 flex items-center justify-center transition">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="p-8 text-center text-slate-400">
                            Tidak ada permohonan pendaftaran keanggotaan online.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-4 border-t border-slate-100">
        {{ $registrations->links() }}
    </div>
</div>

@endsection
