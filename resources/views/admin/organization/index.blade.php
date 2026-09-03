@extends('layouts.admin')

@section('title', 'Struktur Pengurus DPD APPSI')

@section('content')

<div class="space-y-6" x-data="{ modalTambah: false, editModal: false, editData: {} }">
    
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900">Susunan Pengurus DPD APPSI Banyuasin</h1>
            <p class="text-xs text-slate-500 mt-1">Struktur pimpinan harian, divisi bidang, dan koordinator komisariat pasar daerah</p>
        </div>
        <button @click="modalTambah = true" class="inline-flex items-center gap-2 rounded-xl bg-emerald-700 px-4 py-2.5 text-xs font-bold text-white shadow-sm hover:bg-emerald-800 transition">
            <i class="fa-solid fa-plus text-xs"></i>
            <span>Tambah Pengurus Baru</span>
        </button>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr>
                        <th class="p-3.5 text-center w-12">No</th>
                        <th class="p-3.5">Foto & Nama Pengurus</th>
                        <th class="p-3.5">Jabatan</th>
                        <th class="p-3.5">Divisi / Bidang</th>
                        <th class="p-3.5">Kontak</th>
                        <th class="p-3.5 text-center">Urutan</th>
                        <th class="p-3.5 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($officials as $index => $item)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="p-3.5 text-center text-slate-400 font-bold">{{ $officials->firstItem() + $index }}</td>
                            <td class="p-3.5">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full overflow-hidden bg-slate-100 shrink-0 border border-slate-200">
                                        <img src="{{ $item->foto_url }}" alt="" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <span class="font-bold text-slate-900 block">{{ $item->nama }}</span>
                                        <span class="text-[10px] text-slate-400">{{ $item->periode ?? '2024 - 2029' }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="p-3.5 font-semibold text-emerald-900">{{ $item->jabatan }}</td>
                            <td class="p-3.5">
                                <span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-emerald-50 text-emerald-800 border border-emerald-200">
                                    {{ $item->divisi ?? 'Pengurus' }}
                                </span>
                            </td>
                            <td class="p-3.5 text-slate-600 font-mono text-[11px]">
                                {{ $item->no_hp ?? ($item->email ?? '-') }}
                            </td>
                            <td class="p-3.5 text-center font-bold text-slate-700 font-mono">
                                {{ $item->urutan }}
                            </td>
                            <td class="p-3.5 text-center">
                                <div class="flex items-center justify-center gap-1.5">
                                    <button type="button" @click="editData = {{ json_encode($item) }}; editModal = true" class="h-8 w-8 rounded-lg bg-blue-50 text-blue-700 hover:bg-blue-100 flex items-center justify-center transition" title="Edit">
                                        <i class="fa-solid fa-pen-to-square text-xs"></i>
                                    </button>
                                    <form action="{{ route('admin.organization.destroy', $item->id) }}" method="POST" onsubmit="return confirmDelete(this, 'Hapus data pengurus {{ addslashes($item->nama) }}?')">
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
                                Belum ada data pengurus yang tersimpan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-slate-100">
            {{ $officials->links() }}
        </div>
    </div>

    <!-- Modal Tambah Pengurus -->
    <div x-show="modalTambah" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/60 p-4 backdrop-blur-sm" @click.self="modalTambah = false">
        <div class="w-full max-w-lg bg-white rounded-2xl p-6 shadow-2xl space-y-4">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <h3 class="text-base font-bold text-slate-900">Tambah Pengurus APPSI</h3>
                <button type="button" @click="modalTambah = false" class="text-slate-400 hover:text-slate-600">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form action="{{ route('admin.organization.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Nama Lengkap Pengurus *</label>
                    <input type="text" name="nama" required class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:border-emerald-600">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Jabatan *</label>
                        <input type="text" name="jabatan" required class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:border-emerald-600" placeholder="Contoh: Wakil Ketua I">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Divisi / Bidang</label>
                        <select name="divisi" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:border-emerald-600 bg-white">
                            <option value="Pimpinan Harian">Pimpinan Harian</option>
                            <option value="Sekretariat">Sekretariat</option>
                            <option value="Kebendaharaan">Kebendaharaan</option>
                            <option value="Bidang Sarana Pasar">Bidang Sarana Pasar</option>
                            <option value="Bidang Pemberdayaan Perempuan">Bidang Pemberdayaan Perempuan</option>
                            <option value="Komisariat Pasar">Komisariat Pasar</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Urutan</label>
                        <input type="number" name="urutan" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:border-emerald-600" placeholder="1, 2, 3...">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Periode</label>
                        <input type="text" name="periode" value="2024 - 2029" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:border-emerald-600">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">No. WhatsApp / HP</label>
                        <input type="text" name="no_hp" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:border-emerald-600">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Email</label>
                        <input type="email" name="email" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:border-emerald-600">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Foto Pengurus (Opsional)</label>
                    <input type="file" name="foto" accept="image/*" class="w-full text-xs text-slate-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700">
                </div>

                <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2">
                    <button type="button" @click="modalTambah = false" class="px-4 py-2 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-50">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-emerald-700 text-white text-xs font-bold hover:bg-emerald-800 shadow">
                        Simpan Pengurus
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Pengurus -->
    <div x-show="editModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/60 p-4 backdrop-blur-sm" @click.self="editModal = false">
        <div class="w-full max-w-lg bg-white rounded-2xl p-6 shadow-2xl space-y-4">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <h3 class="text-base font-bold text-slate-900">Edit Pengurus APPSI</h3>
                <button type="button" @click="editModal = false" class="text-slate-400 hover:text-slate-600">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form :action="'{{ url('admin/struktur-organisasi') }}/' + editData.id" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Nama Lengkap Pengurus *</label>
                    <input type="text" name="nama" required :value="editData.nama" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:border-emerald-600">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Jabatan *</label>
                        <input type="text" name="jabatan" required :value="editData.jabatan" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:border-emerald-600">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Divisi / Bidang</label>
                        <input type="text" name="divisi" :value="editData.divisi" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:border-emerald-600">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Urutan</label>
                        <input type="number" name="urutan" :value="editData.urutan" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:border-emerald-600">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Periode</label>
                        <input type="text" name="periode" :value="editData.periode" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:border-emerald-600">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">No. WhatsApp / HP</label>
                        <input type="text" name="no_hp" :value="editData.no_hp" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:border-emerald-600">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Email</label>
                        <input type="email" name="email" :value="editData.email" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:border-emerald-600">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Ganti Foto (Opsional)</label>
                    <input type="file" name="foto" accept="image/*" class="w-full text-xs text-slate-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700">
                </div>

                <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2">
                    <button type="button" @click="editModal = false" class="px-4 py-2 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-50">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-emerald-700 text-white text-xs font-bold hover:bg-emerald-800 shadow">
                        Perbarui Data
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection
