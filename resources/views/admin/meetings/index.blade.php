@extends('layouts.admin')

@section('title', 'Notulen Rapat & Musyawarah')

@section('content')

<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900">Notulen Rapat & Musyawarah Pasar</h1>
        <p class="text-xs text-slate-500 mt-1">Dokumentasi hasil musyawarah, koordinasi komisariat, dan rapat pengurus DPD APPSI Banyuasin</p>
    </div>
    <a href="{{ route('admin.meetings.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-emerald-700 px-4 py-2.5 text-xs font-bold text-white shadow-sm hover:bg-emerald-800 transition">
        <i class="fa-solid fa-plus text-xs"></i>
        <span>Catat Rapat Baru</span>
    </a>
</div>

<div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs">
            <thead>
                <tr>
                    <th class="p-3.5">Tanggal & Waktu</th>
                    <th class="p-3.5">Judul Rapat & Tempat</th>
                    <th class="p-3.5">Pimpinan & Notulis</th>
                    <th class="p-3.5">Agenda / Keputusan</th>
                    <th class="p-3.5 text-center">Hadir</th>
                    <th class="p-3.5 text-center">Status</th>
                    <th class="p-3.5 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($meetings as $mt)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="p-3.5 whitespace-nowrap">
                            <span class="font-bold text-slate-900 block">{{ $mt->tanggal ? $mt->tanggal->format('d/m/Y') : '-' }}</span>
                            <span class="text-[10px] text-slate-400 font-mono">{{ $mt->waktu_mulai ?? '' }} - {{ $mt->waktu_selesai ?? 'Selesai' }}</span>
                        </td>
                        <td class="p-3.5">
                            <span class="font-bold text-slate-900 block">{{ $mt->judul_rapat }}</span>
                            <span class="text-[10px] text-slate-500"><i class="fa-solid fa-location-dot mr-1 text-emerald-700"></i>{{ $mt->tempat }}</span>
                        </td>
                        <td class="p-3.5">
                            <span class="font-medium text-slate-800 block">Pim: {{ $mt->pimpinan_rapat }}</span>
                            <span class="text-[10px] text-slate-500">Not: {{ $mt->notulis }}</span>
                        </td>
                        <td class="p-3.5 max-w-xs truncate text-slate-600">
                            {{ $mt->keputusan ?? $mt->agenda }}
                        </td>
                        <td class="p-3.5 text-center font-bold text-emerald-800 font-mono">
                            {{ $mt->jumlah_hadir ?? '-' }}
                        </td>
                        <td class="p-3.5 text-center">
                            @if($mt->status === 'selesai')
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">Selesai</span>
                            @elseif($mt->status === 'berlangsung')
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800">Berlangsung</span>
                            @else
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-100 text-blue-800">Terjadwal</span>
                            @endif
                        </td>
                        <td class="p-3.5 text-center">
                            <div class="flex items-center justify-center gap-1.5">
                                <a href="{{ route('admin.meetings.show', $mt->id) }}" class="h-8 px-2 rounded-lg bg-emerald-50 text-emerald-700 hover:bg-emerald-100 flex items-center gap-1 text-[11px] font-bold transition">
                                    <i class="fa-solid fa-eye"></i> Detail
                                </a>
                                <a href="{{ route('admin.meetings.edit', $mt->id) }}" class="h-8 w-8 rounded-lg bg-blue-50 text-blue-700 hover:bg-blue-100 flex items-center justify-center transition">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('admin.meetings.destroy', $mt->id) }}" method="POST" onsubmit="return confirmDelete(this, 'Hapus catatan rapat ini?')">
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
                            Belum ada catatan notulen rapat yang tersimpan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-4 border-t border-slate-100">
        {{ $meetings->links() }}
    </div>
</div>

@endsection
