@extends('layouts.admin')

@section('title', 'Surat Keluar Resmi APPSI')

@section('content')

<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900">Buku Register Surat Keluar</h1>
        <p class="text-xs text-slate-500 mt-1">Pengarsipan digital & penerbitan surat resmi ber-KOP DPD APPSI Banyuasin dengan verifikasi QR Code</p>
    </div>
    <a href="{{ route('admin.letters.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-emerald-700 px-4 py-2.5 text-xs font-bold text-white shadow-sm hover:bg-emerald-800 transition">
        <i class="fa-solid fa-plus text-xs"></i>
        <span>Buat Surat Keluar Baru</span>
    </a>
</div>

<!-- Table Card -->
<div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs">
            <thead>
                <tr>
                    <th class="p-3.5">Nomor Surat</th>
                    <th class="p-3.5">Tanggal</th>
                    <th class="p-3.5">Jenis Dokumen</th>
                    <th class="p-3.5">Tujuan Surat</th>
                    <th class="p-3.5">Perihal / Keperluan</th>
                    <th class="p-3.5 text-center">Status QR</th>
                    <th class="p-3.5 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($letters as $lt)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="p-3.5 font-bold text-slate-900 font-mono">{{ $lt->nomor_surat }}</td>
                        <td class="p-3.5 text-slate-600 whitespace-nowrap">{{ $lt->tanggal ? $lt->tanggal->format('d/m/Y') : '-' }}</td>
                        <td class="p-3.5">
                            <span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-slate-100 text-slate-700">
                                {{ $lt->jenis_surat }}
                            </span>
                        </td>
                        <td class="p-3.5 font-medium text-slate-800">{{ $lt->tujuan }}</td>
                        <td class="p-3.5 text-slate-600 max-w-xs truncate">{{ $lt->perihal ?? $lt->keperluan }}</td>
                        <td class="p-3.5 text-center">
                            <a href="{{ route('letter.verify', $lt->hash_keabsahan) }}" target="_blank" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800 hover:bg-emerald-200 transition">
                                <i class="fa-solid fa-qrcode text-[9px]"></i> Valid
                            </a>
                        </td>
                        <td class="p-3.5 text-center">
                            <div class="flex items-center justify-center gap-1.5">
                                <a href="{{ route('admin.letters.show', $lt->id) }}" target="_blank" class="h-8 px-2.5 rounded-lg bg-emerald-50 text-emerald-700 hover:bg-emerald-100 flex items-center gap-1 text-[11px] font-bold transition" title="Cetak Surat">
                                    <i class="fa-solid fa-print"></i> Cetak
                                </a>
                                <a href="{{ route('admin.letters.edit', $lt->id) }}" class="h-8 px-2.5 rounded-lg bg-blue-50 text-blue-700 hover:bg-blue-100 flex items-center gap-1 text-[11px] font-bold transition" title="Edit Surat">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.letters.destroy', $lt->id) }}" method="POST" onsubmit="return confirmDelete(this, 'Hapus surat nomor {{ addslashes($lt->nomor_surat) }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="h-8 w-8 rounded-lg bg-slate-100 text-slate-500 hover:bg-red-50 hover:text-red-600 flex items-center justify-center transition" title="Hapus Surat">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="p-8 text-center text-slate-400">
                            Belum ada surat keluar yang diterbitkan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-4 border-t border-slate-100">
        {{ $letters->links() }}
    </div>
</div>

@endsection
