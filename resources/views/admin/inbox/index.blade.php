@extends('layouts.admin')

@section('title', 'Aspirasi & Buku Tamu')

@section('content')

<div class="space-y-6" x-data="{ detailModal: false, activeItem: {} }">
    
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900">Aspirasi Pedagang & Buku Tamu</h1>
            <p class="text-xs text-slate-500 mt-1">Daftar aspirasi, pengaduan fasilitas pasar, dan pesan masuk dari website appsiba.or.id</p>
        </div>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr>
                        <th class="p-3.5">Tanggal</th>
                        <th class="p-3.5">Pengirim & Instansi</th>
                        <th class="p-3.5">Kontak</th>
                        <th class="p-3.5">Tujuan & Keperluan</th>
                        <th class="p-3.5">Ringkasan Pesan</th>
                        <th class="p-3.5 text-center">Status</th>
                        <th class="p-3.5 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($inboxes as $inbox)
                        <tr class="hover:bg-slate-50 transition {{ $inbox->status === 'baru' ? 'bg-emerald-50/20' : '' }}">
                            <td class="p-3.5 text-slate-500 whitespace-nowrap">
                                {{ $inbox->tanggal ? $inbox->tanggal->format('d/m/Y H:i') : '-' }}
                            </td>
                            <td class="p-3.5">
                                <span class="font-bold text-slate-900 block">{{ $inbox->nama }}</span>
                                <span class="text-[10px] text-slate-500">{{ $inbox->instansi ?? 'Pedagang / Masyarakat' }}</span>
                            </td>
                            <td class="p-3.5 text-slate-600 font-mono text-[11px]">
                                {{ $inbox->telepon ?? ($inbox->email ?? '-') }}
                            </td>
                            <td class="p-3.5">
                                <span class="font-semibold text-slate-800 block">{{ $inbox->keperluan }}</span>
                                <span class="text-[10px] text-slate-400">{{ $inbox->tujuan }}</span>
                            </td>
                            <td class="p-3.5 max-w-xs truncate text-slate-600">
                                {{ $inbox->pesan }}
                            </td>
                            <td class="p-3.5 text-center">
                                @if($inbox->status === 'baru')
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800 animate-pulse">Baru</span>
                                @else
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-500">Dibaca</span>
                                @endif
                            </td>
                            <td class="p-3.5 text-center">
                                <div class="flex items-center justify-center gap-1.5">
                                    <button type="button" @click="activeItem = {{ json_encode($inbox) }}; detailModal = true" class="h-8 px-2.5 rounded-lg bg-emerald-50 text-emerald-700 hover:bg-emerald-100 text-xs font-bold transition flex items-center gap-1">
                                        <i class="fa-solid fa-eye"></i> Baca
                                    </button>
                                    <form action="{{ route('admin.inbox.destroy', $inbox->id) }}" method="POST" onsubmit="return confirmDelete(this, 'Hapus pesan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="h-8 w-8 rounded-lg bg-slate-100 text-slate-500 hover:bg-red-50 hover:text-red-600 flex items-center justify-center transition">
                                            <i class="fa-solid fa-trash-can text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-8 text-center text-slate-400">
                                Belum ada pesan aspirasi masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-slate-100">
            {{ $inboxes->links() }}
        </div>
    </div>

    <!-- Modal Detail Pesan -->
    <div x-show="detailModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/60 p-4 backdrop-blur-sm" @click.self="detailModal = false">
        <div class="w-full max-w-lg bg-white rounded-2xl p-6 shadow-2xl space-y-4">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <h3 class="text-base font-bold text-slate-900">Rincian Pesan Aspirasi</h3>
                <button type="button" @click="detailModal = false" class="text-slate-400 hover:text-slate-600">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <div class="space-y-3 text-xs">
                <div class="grid grid-cols-2 gap-3 bg-slate-50 p-3 rounded-xl">
                    <div>
                        <span class="text-[10px] uppercase font-bold text-slate-400 block">Pengirim</span>
                        <span class="font-bold text-slate-900 text-sm block mt-0.5" x-text="activeItem.nama"></span>
                        <span class="text-[11px] text-slate-500 block" x-text="activeItem.instansi"></span>
                    </div>
                    <div>
                        <span class="text-[10px] uppercase font-bold text-slate-400 block">Kontak</span>
                        <span class="font-mono text-slate-700 block mt-0.5" x-text="activeItem.telepon || '-'"></span>
                        <span class="text-slate-500 block" x-text="activeItem.email || '-'"></span>
                    </div>
                </div>

                <div>
                    <span class="text-[10px] uppercase font-bold text-slate-400 block">Tujuan & Keperluan</span>
                    <span class="font-bold text-slate-800 text-sm block mt-0.5" x-text="activeItem.keperluan"></span>
                    <span class="text-slate-500 block text-[11px]" x-text="'Tujuan: ' + activeItem.tujuan"></span>
                </div>

                <div>
                    <span class="text-[10px] uppercase font-bold text-slate-400 block mb-1">Isi Pesan / Aspirasi:</span>
                    <div class="p-4 rounded-xl border border-slate-200 bg-white text-slate-800 whitespace-pre-line leading-relaxed text-xs" x-text="activeItem.pesan"></div>
                </div>
            </div>

            <div class="pt-3 border-t border-slate-100 flex items-center justify-end">
                <button type="button" @click="detailModal = false" class="px-5 py-2 rounded-xl bg-slate-900 text-white font-bold text-xs hover:bg-slate-800">
                    Tutup
                </button>
            </div>
        </div>
    </div>

</div>

@endsection
