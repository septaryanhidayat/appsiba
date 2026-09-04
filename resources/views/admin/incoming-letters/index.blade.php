@extends('layouts.admin')

@section('title', 'Surat Masuk & Pengarsipan')

@section('content')

<div class="space-y-6" x-data="{ modalTambah: false, editModal: false, editData: {} }">
    
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900">Buku Arsip Surat Masuk</h1>
            <p class="text-xs text-slate-500 mt-1">Pencatatan surat dinas dari instansi pemerintah, BUMD pasar, perbankan, dan kemitraan luar</p>
        </div>
        <button @click="modalTambah = true" class="inline-flex items-center gap-2 rounded-xl bg-emerald-700 px-4 py-2.5 text-xs font-bold text-white shadow-sm hover:bg-emerald-800 transition">
            <i class="fa-solid fa-plus text-xs"></i>
            <span>Catat Surat Masuk</span>
        </button>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr>
                        <th class="p-3.5">Tanggal Diterima</th>
                        <th class="p-3.5">Nomor & Tanggal Surat</th>
                        <th class="p-3.5">Instansi Pengirim</th>
                        <th class="p-3.5">Perihal / Hal</th>
                        <th class="p-3.5">Status Disposisi</th>
                        <th class="p-3.5 text-center">Lampiran</th>
                        <th class="p-3.5 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($letters as $lt)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="p-3.5 whitespace-nowrap text-slate-500">
                                {{ $lt->tanggal_diterima ? $lt->tanggal_diterima->format('d/m/Y') : '-' }}
                            </td>
                            <td class="p-3.5">
                                <span class="font-bold text-slate-900 block font-mono">{{ $lt->nomor_surat }}</span>
                                <span class="text-[10px] text-slate-400">Tgl Surat: {{ $lt->tanggal_surat ? $lt->tanggal_surat->format('d/m/Y') : '-' }}</span>
                            </td>
                            <td class="p-3.5 font-semibold text-slate-800">{{ $lt->pengirim }}</td>
                            <td class="p-3.5 text-slate-600 max-w-xs truncate">{{ $lt->perihal }}</td>
                            <td class="p-3.5">
                                <span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-slate-100 text-slate-700">
                                    {{ $lt->status_disposisi ?? 'Belum Disposisi' }}
                                </span>
                            </td>
                            <td class="p-3.5 text-center">
                                @if($lt->file_lampiran)
                                    <a href="{{ asset('storage/' . $lt->file_lampiran) }}" target="_blank" class="text-emerald-700 hover:underline font-bold text-xs">
                                        <i class="fa-solid fa-file-arrow-down"></i> Unduh
                                    </a>
                                @else
                                    <span class="text-slate-400">-</span>
                                @endif
                            </td>
                            <td class="p-3.5 text-center">
                                <div class="flex items-center justify-center gap-1.5">
                                    <button type="button" @click="editData = {{ json_encode($lt) }}; editModal = true" class="h-8 w-8 rounded-lg bg-blue-50 text-blue-700 hover:bg-blue-100 flex items-center justify-center transition" title="Edit Surat Masuk">
                                        <i class="fa-solid fa-pen-to-square text-xs"></i>
                                    </button>
                                    <form action="{{ route('admin.incoming-letters.destroy', $lt->id) }}" method="POST" onsubmit="return confirmDelete(this, 'Hapus rekaman surat masuk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="h-8 w-8 rounded-lg bg-slate-100 text-slate-500 hover:bg-red-50 hover:text-red-600 flex items-center justify-center transition" title="Hapus">
                                            <i class="fa-solid fa-trash-can text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-8 text-center text-slate-400">
                                Belum ada arsip surat masuk yang dicatat.
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

    <!-- Modal Catat Surat Masuk -->
    <div x-show="modalTambah" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/60 p-4 backdrop-blur-sm" @click.self="modalTambah = false">
        <div class="w-full max-w-lg bg-white rounded-2xl p-6 shadow-2xl space-y-4">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <h3 class="text-base font-bold text-slate-900">Catat Surat Masuk Baru</h3>
                <button type="button" @click="modalTambah = false" class="text-slate-400 hover:text-slate-600">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form action="{{ route('admin.incoming-letters.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Nomor Surat Masuk *</label>
                        <input type="text" name="nomor_surat" required class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:border-emerald-600">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Tanggal Surat *</label>
                        <input type="date" name="tanggal_surat" required value="{{ date('Y-m-d') }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:border-emerald-600">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Tanggal Diterima *</label>
                        <input type="date" name="tanggal_diterima" required value="{{ date('Y-m-d') }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:border-emerald-600">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Status Disposisi</label>
                        <input type="text" name="status_disposisi" value="Diteruskan ke Ketua DPD" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:border-emerald-600">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Instansi / Pihak Pengirim *</label>
                    <input type="text" name="pengirim" required class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:border-emerald-600" placeholder="Contoh: Dinas Koperindag Kab. Banyuasin">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Perihal Surat *</label>
                    <input type="text" name="perihal" required class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:border-emerald-600" placeholder="Contoh: Undangan Rakor Stabilitas Harga Pangan">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Isi Ringkas Surat</label>
                    <textarea name="isi_ringkas" rows="2" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:border-emerald-600"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Scan / Berkas Surat (PDF/JPG)</label>
                    <input type="file" name="file_lampiran" class="w-full text-xs text-slate-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700">
                </div>

                <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2">
                    <button type="button" @click="modalTambah = false" class="px-4 py-2 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-50">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-emerald-700 text-white text-xs font-bold hover:bg-emerald-800 shadow">
                        Simpan Arsip Surat Masuk
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Surat Masuk -->
    <div x-show="editModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/60 p-4 backdrop-blur-sm" @click.self="editModal = false">
        <div class="w-full max-w-lg bg-white rounded-2xl p-6 shadow-2xl space-y-4">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <h3 class="text-base font-bold text-slate-900">Edit Arsip Surat Masuk</h3>
                <button type="button" @click="editModal = false" class="text-slate-400 hover:text-slate-600">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form :action="'{{ url('admin/surat-masuk') }}/' + editData.id" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Nomor Surat Masuk *</label>
                        <input type="text" name="nomor_surat" x-model="editData.nomor_surat" required class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:border-emerald-600">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Tanggal Surat *</label>
                        <input type="date" name="tanggal_surat" :value="editData.tanggal_surat ? editData.tanggal_surat.substring(0,10) : ''" @input="editData.tanggal_surat = $event.target.value" required class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:border-emerald-600">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Tanggal Diterima *</label>
                        <input type="date" name="tanggal_terima" :value="editData.tanggal_terima ? editData.tanggal_terima.substring(0,10) : (editData.tanggal_diterima ? editData.tanggal_diterima.substring(0,10) : '')" @input="editData.tanggal_terima = $event.target.value" required class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:border-emerald-600">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Status Disposisi</label>
                        <input type="text" name="disposisi" x-model="editData.disposisi" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:border-emerald-600">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Instansi / Pihak Pengirim *</label>
                    <input type="text" name="pengirim" x-model="editData.pengirim" required class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:border-emerald-600">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Perihal Surat *</label>
                    <input type="text" name="perihal" x-model="editData.perihal" required class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:border-emerald-600">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Keterangan / Isi Ringkas</label>
                    <textarea name="keterangan" x-model="editData.keterangan" rows="2" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:border-emerald-600"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Ganti Berkas / Scan Surat (Opsional)</label>
                    <input type="file" name="file_lampiran" class="w-full text-xs text-slate-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700">
                    <p class="text-[10px] text-slate-400 mt-1">Biarkan kosong jika tidak ingin mengubah berkas scan surat saat ini.</p>
                </div>

                <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2">
                    <button type="button" @click="editModal = false" class="px-4 py-2 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-50">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-emerald-700 text-white text-xs font-bold hover:bg-emerald-800 shadow">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection
