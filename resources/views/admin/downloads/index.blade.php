@extends('layouts.admin')

@section('title', 'Pusat Unduhan & Berkas Dokumen')

@section('content')

<div class="space-y-6" x-data="{ modalTambah: false, editModal: false, editData: {} }">
    
    <!-- Header Page -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2">
                <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">Pusat Unduhan & Berkas Dokumen</h1>
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                    Publik & Arsip
                </span>
            </div>
            <p class="text-xs text-slate-500 mt-1">Kelola dokumen resmi, formulir keanggotaan offline, berkas permodalan KUR, dan regulasi DPD APPSI</p>
        </div>
        <button @click="modalTambah = true" class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-700 px-4 py-2.5 text-xs font-bold text-white shadow-sm hover:bg-emerald-800 transition">
            <i class="fa-solid fa-cloud-arrow-up text-xs"></i>
            <span>Tambah Dokumen Baru</span>
        </button>
    </div>

    <!-- Stats Quick Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white rounded-2xl p-4 border border-slate-200/80 shadow-sm flex items-center gap-3.5">
            <div class="h-11 w-11 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-lg shrink-0">
                <i class="fa-solid fa-file-lines"></i>
            </div>
            <div>
                <span class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400 block">Total Dokumen</span>
                <span class="text-xl font-black text-slate-900 leading-none">{{ $stats['total_dokumen'] }} Berkas</span>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-4 border border-slate-200/80 shadow-sm flex items-center gap-3.5">
            <div class="h-11 w-11 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center text-lg shrink-0">
                <i class="fa-solid fa-download"></i>
            </div>
            <div>
                <span class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400 block">Total Diunduh</span>
                <span class="text-xl font-black text-slate-900 leading-none">{{ number_format($stats['total_unduhan']) }} Kali</span>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-4 border border-slate-200/80 shadow-sm flex items-center gap-3.5">
            <div class="h-11 w-11 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center text-lg shrink-0">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div>
                <span class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400 block">Dokumen Aktif</span>
                <span class="text-xl font-black text-slate-900 leading-none">{{ $stats['total_aktif'] }} Terbit Publik</span>
            </div>
        </div>
    </div>

    <!-- Filter & Table Card -->
    <div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-sm">
        
        <!-- Filter Bar -->
        <div class="p-4 border-b border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3 bg-slate-50/50">
            <form action="{{ route('admin.downloads.index') }}" method="GET" class="flex flex-col sm:flex-row items-center gap-2.5 w-full sm:w-auto">
                <div class="relative w-full sm:w-64">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul dokumen..." class="w-full rounded-xl border border-slate-200 pl-8 pr-3 py-1.5 text-xs focus:outline-none focus:border-emerald-600 bg-white">
                    <i class="fa-solid fa-magnifying-glass absolute left-2.5 top-2.5 text-slate-400 text-xs"></i>
                </div>

                <select name="kategori" onchange="this.form.submit()" class="w-full sm:w-auto rounded-xl border border-slate-200 px-3 py-1.5 text-xs focus:outline-none focus:border-emerald-600 bg-white">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ request('kategori') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>

                @if(request('q') || request('kategori'))
                    <a href="{{ route('admin.downloads.index') }}" class="text-xs text-red-600 font-bold hover:underline">Reset</a>
                @endif
            </form>

            <span class="text-xs text-slate-400">Total: {{ $documents->total() }} Berkas</span>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs min-w-[700px]">
                <thead>
                    <tr class="bg-slate-50/80 text-slate-500 border-b border-slate-100 uppercase tracking-wider text-[10px]">
                        <th class="p-3.5 text-center w-12">No</th>
                        <th class="p-3.5">Judul & Nama Berkas</th>
                        <th class="p-3.5">Kategori</th>
                        <th class="p-3.5 text-center">Ukuran & Tipe</th>
                        <th class="p-3.5 text-center">Diunduh</th>
                        <th class="p-3.5 text-center">Status</th>
                        <th class="p-3.5 text-center w-28">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($documents as $doc)
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="p-3.5 text-center text-slate-400 font-bold">
                                {{ $loop->iteration + ($documents->currentPage() - 1) * $documents->perPage() }}
                            </td>
                            <td class="p-3.5">
                                <span class="font-bold text-slate-900 block text-sm">{{ $doc->judul }}</span>
                                @if($doc->deskripsi)
                                    <p class="text-[11px] text-slate-500 mt-0.5 line-clamp-1">{{ $doc->deskripsi }}</p>
                                @endif
                                <span class="text-[10px] text-slate-400 block mt-0.5 font-mono">
                                    <i class="fa-regular fa-file text-[9px]"></i> {{ $doc->nama_file }}
                                </span>
                            </td>
                            <td class="p-3.5">
                                <span class="inline-flex items-center px-2 py-0.5 rounded-lg text-[10px] font-bold bg-slate-100 text-slate-700">
                                    {{ $doc->kategori }}
                                </span>
                            </td>
                            <td class="p-3.5 text-center">
                                <span class="inline-flex items-center gap-1 font-bold text-slate-700 uppercase">
                                    <span class="px-1.5 py-0.5 rounded bg-red-100 text-red-800 text-[10px] font-extrabold">{{ $doc->tipe_file }}</span>
                                    <span class="text-[11px] text-slate-500 lowercase">{{ $doc->ukuran_file }}</span>
                                </span>
                            </td>
                            <td class="p-3.5 text-center">
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-blue-700">
                                    <i class="fa-solid fa-download text-[8px]"></i> {{ number_format($doc->jumlah_unduhan) }}
                                </span>
                            </td>
                            <td class="p-3.5 text-center">
                                @if($doc->is_aktif)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                        Aktif Publik
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-500">
                                        Disembunyikan
                                    </span>
                                @endif
                            </td>
                            <td class="p-3.5 text-center">
                                <div class="flex items-center justify-center gap-1.5">
                                    <!-- Tombol Download Nyata -->
                                    <a href="{{ route('admin.downloads.download', $doc->id) }}" class="h-8 w-8 rounded-lg bg-emerald-50 text-emerald-700 hover:bg-emerald-100 flex items-center justify-center transition" title="Unduh Berkas Nyata">
                                        <i class="fa-solid fa-file-arrow-down text-xs"></i>
                                    </a>

                                    <!-- Tombol Edit -->
                                    <button type="button" @click="editData = {{ json_encode($doc) }}; editModal = true" class="h-8 w-8 rounded-lg bg-blue-50 text-blue-700 hover:bg-blue-100 flex items-center justify-center transition" title="Edit Data Dokumen">
                                        <i class="fa-solid fa-pen-to-square text-xs"></i>
                                    </button>

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('admin.downloads.destroy', $doc->id) }}" method="POST" onsubmit="return confirmDelete(this, 'Hapus dokumen unduhan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="h-8 w-8 rounded-lg bg-slate-100 text-slate-500 hover:bg-red-50 hover:text-red-600 flex items-center justify-center transition" title="Hapus Dokumen">
                                            <i class="fa-solid fa-trash-can text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-8 text-center text-slate-400">
                                <i class="fa-solid fa-folder-open text-3xl mb-2 text-slate-300 block"></i>
                                Belum ada berkas dokumen unduhan yang tersimpan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($documents->hasPages())
            <div class="p-4 border-t border-slate-100">
                {{ $documents->links() }}
            </div>
        @endif
    </div>

    <!-- Modal Tambah Dokumen Unduhan -->
    <div x-show="modalTambah" x-cloak class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-7 shadow-2xl border border-slate-100 animate-in fade-in zoom-in duration-200" @click.away="modalTambah = false">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                <div class="flex items-center gap-2.5">
                    <div class="h-9 w-9 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-sm">
                        <i class="fa-solid fa-file-circle-plus"></i>
                    </div>
                    <div>
                        <h3 class="text-base font-extrabold text-slate-900">Tambah Dokumen Unduhan</h3>
                        <p class="text-[11px] text-slate-400">Unggah berkas resmi untuk diunduh publik</p>
                    </div>
                </div>
                <button type="button" @click="modalTambah = false" class="text-slate-400 hover:text-slate-600">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <form action="{{ route('admin.downloads.store') }}" method="POST" enctype="multipart/form-data" class="mt-5 space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1.5">Judul Dokumen *</label>
                    <input type="text" name="judul" required placeholder="Contoh: Formulir Pendaftaran Anggota (Offline)" class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-xs sm:text-sm focus:outline-none focus:border-emerald-600 bg-slate-50/50 font-medium">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1.5">Kategori Dokumen *</label>
                        <input type="text" name="kategori" required list="kategori_list" placeholder="Contoh: Formulir Keanggotaan" class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-xs sm:text-sm focus:outline-none focus:border-emerald-600 bg-slate-50/50 font-medium">
                        <datalist id="kategori_list">
                            <option value="Formulir Keanggotaan">
                            <option value="Advokasi & Permodalan">
                            <option value="Legalitas & Organisasi">
                            <option value="Regulasi & Peraturan Pasar">
                            <option value="Laporan & Warta Resmi">
                        </datalist>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1.5">Urutan Tampil</label>
                        <input type="number" name="urutan" value="1" min="0" class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-xs sm:text-sm focus:outline-none focus:border-emerald-600 bg-slate-50/50 font-medium">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1.5">Pilih Berkas File *</label>
                    <input type="file" name="berkas" required accept=".pdf,.docx,.doc,.xlsx,.xls,.zip,.rar" class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                    <p class="text-[10px] text-slate-400 mt-1">Mendukung format PDF, DOCX, XLSX, ZIP. Maksimal ukuran 25 MB.</p>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1.5">Deskripsi / Keterangan Berkas</label>
                    <textarea name="deskripsi" rows="3" placeholder="Tuliskan keterangan singkat tentang berkas dokumen ini..." class="w-full rounded-xl border border-slate-200 p-3 text-xs sm:text-sm focus:outline-none focus:border-emerald-600 bg-slate-50/50 font-medium"></textarea>
                </div>

                <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2.5">
                    <button type="button" @click="modalTambah = false" class="px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50 transition">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-emerald-700 text-xs font-bold text-white hover:bg-emerald-800 transition shadow-sm">
                        Simpan & Publikasikan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Dokumen Unduhan -->
    <div x-show="editModal" x-cloak class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-7 shadow-2xl border border-slate-100 animate-in fade-in zoom-in duration-200" @click.away="editModal = false">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                <div class="flex items-center gap-2.5">
                    <div class="h-9 w-9 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center text-sm">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </div>
                    <div>
                        <h3 class="text-base font-extrabold text-slate-900">Edit Dokumen Unduhan</h3>
                        <p class="text-[11px] text-slate-400">Perbarui informasi berkas resmi</p>
                    </div>
                </div>
                <button type="button" @click="editModal = false" class="text-slate-400 hover:text-slate-600">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <form :action="'{{ url('admin/unduhan') }}/' + editData.id" method="POST" enctype="multipart/form-data" class="mt-5 space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1.5">Judul Dokumen *</label>
                    <input type="text" name="judul" x-model="editData.judul" required class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-xs sm:text-sm focus:outline-none focus:border-emerald-600 bg-slate-50/50 font-medium">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1.5">Kategori Dokumen *</label>
                        <input type="text" name="kategori" x-model="editData.kategori" required list="kategori_list" class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-xs sm:text-sm focus:outline-none focus:border-emerald-600 bg-slate-50/50 font-medium">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1.5">Urutan Tampil</label>
                        <input type="number" name="urutan" x-model="editData.urutan" min="0" class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-xs sm:text-sm focus:outline-none focus:border-emerald-600 bg-slate-50/50 font-medium">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1.5">Ganti Berkas (Opsional)</label>
                    <input type="file" name="berkas" accept=".pdf,.docx,.doc,.xlsx,.xls,.zip,.rar" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    <p class="text-[10px] text-slate-400 mt-1">Biarkan kosong jika tidak ingin mengubah berkas saat ini (<span class="font-mono" x-text="editData.nama_file"></span>).</p>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1.5">Deskripsi / Keterangan Berkas</label>
                    <textarea name="deskripsi" x-model="editData.deskripsi" rows="3" class="w-full rounded-xl border border-slate-200 p-3 text-xs sm:text-sm focus:outline-none focus:border-emerald-600 bg-slate-50/50 font-medium"></textarea>
                </div>

                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_aktif" value="1" :checked="editData.is_aktif" id="edit_is_aktif" class="h-4 w-4 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                    <label for="edit_is_aktif" class="text-xs font-semibold text-slate-700">Tampilkan Dokumen di Halaman Unduhan Publik</label>
                </div>

                <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2.5">
                    <button type="button" @click="editModal = false" class="px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50 transition">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-blue-600 text-xs font-bold text-white hover:bg-blue-700 transition shadow-sm">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection
