@extends('layouts.admin')

@section('title', 'Struktur Pengurus DPD APPSI Banyuasin')

@section('content')
<script>
    function orgAdminManager() {
        return {
            tab: 'table',
            modalTambah: false,
            editModal: false,
            structuresData: {
                @foreach($structures as $s)
                    '{{ $s->id }}': {!! json_encode($s) !!},
                @endforeach
            },
            editForm: {
                id: '',
                nama: '',
                jabatan: '',
                divisi: '',
                urutan: 1,
                periode: '2026 - 2031',
                no_hp: '',
                email: '',
            },
            openEdit(id) {
                const s = this.structuresData[id] || {};
                this.editForm = {
                    id: s.id || id,
                    nama: s.nama || '',
                    jabatan: s.jabatan || '',
                    divisi: s.divisi || '',
                    urutan: s.urutan || 1,
                    periode: s.periode || '2026 - 2031',
                    no_hp: s.no_hp || '',
                    email: s.email || '',
                };
                this.editModal = true;
                this.$nextTick(() => {
                    const form = document.getElementById('editOrgForm');
                    if (form) {
                        form.action = '{{ url('admin/struktur-organisasi') }}/' + (s.id || id);
                    }
                });
            }
        };
    }
</script>

<div class="space-y-6" x-data="orgAdminManager()">
    
    <!-- Header & Switcher Tab -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 flex items-center gap-2">
                <span>Susunan Pengurus DPD APPSI Kabupaten Banyuasin</span>
                <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-300">
                    2026–2031
                </span>
            </h1>
            <p class="text-xs text-slate-500 mt-1">Struktur resmi SK DPW APPSI Sumsel No: 012/SK/DPW-APPSI/VI/2026 yang terhubung otomatis ke bagan dan website</p>
        </div>

        <div class="flex flex-col sm:flex-row sm:items-center gap-2.5 w-full sm:w-auto">
            <!-- Tab Switcher (Tabel vs Bagan) -->
            <div class="grid grid-cols-2 sm:inline-flex items-center p-1 rounded-xl bg-white border border-slate-200 shadow-sm">
                <button type="button" 
                        @click="tab = 'table'" 
                        :class="tab === 'table' ? 'bg-emerald-700 text-white shadow-sm' : 'text-slate-600 hover:text-slate-900'"
                        class="inline-flex items-center justify-center gap-1.5 px-3 py-2 sm:py-1.5 rounded-lg text-xs font-bold transition-all cursor-pointer">
                    <i class="fa-solid fa-table-list"></i>
                    <span>Tabel Data</span>
                </button>
                <button type="button" 
                        @click="tab = 'chart'" 
                        :class="tab === 'chart' ? 'bg-emerald-700 text-white shadow-sm' : 'text-slate-600 hover:text-slate-900'"
                        class="inline-flex items-center justify-center gap-1.5 px-3 py-2 sm:py-1.5 rounded-lg text-xs font-bold transition-all cursor-pointer">
                    <i class="fa-solid fa-sitemap"></i>
                    <span>Visualisasi Bagan</span>
                </button>
            </div>

            <button @click="modalTambah = true" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold text-white bg-emerald-700 hover:bg-emerald-800 shadow-sm transition-all cursor-pointer">
                <i class="fa-solid fa-plus"></i>
                <span>Tambah Pengurus</span>
            </button>
        </div>
    </div>

    <!-- TAB 1: VISUALISASI BAGAN HIRARKI (ORG CHART) -->
    <div x-show="tab === 'chart'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
        @include('partials.organization-chart', ['tree' => $tree])
    </div>

    <!-- TAB 2: TABLE CONTAINER -->
    <div x-show="tab === 'table'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="bg-white border border-slate-200/80 rounded-2xl shadow-sm overflow-hidden">
        
        <!-- Filter & Search Bar -->
        <div class="p-4 sm:p-5 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-slate-50/50">
            <div class="flex items-center gap-2">
                <span class="text-xs font-semibold text-slate-700">Tampilkan</span>
                <form action="{{ route('admin.organization.index') }}" method="GET">
                    @if(request('search')) <input type="hidden" name="search" value="{{ request('search') }}"> @endif
                    <select name="entries" onchange="this.form.submit()" class="px-3 py-1.5 rounded-xl bg-white border border-slate-300 text-xs font-semibold text-slate-900 outline-none shadow-sm">
                        <option value="10" {{ request('entries') == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('entries', 25) == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('entries') == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('entries') == 100 ? 'selected' : '' }}>100</option>
                    </select>
                </form>
                <span class="text-xs font-semibold text-slate-700">pengurus</span>
            </div>

            <form action="{{ route('admin.organization.index') }}" method="GET" class="w-full sm:w-72">
                @if(request('entries')) <input type="hidden" name="entries" value="{{ request('entries') }}"> @endif
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama / jabatan / divisi..." class="w-full pl-9 pr-4 py-2 rounded-xl bg-white border border-slate-300 text-xs font-medium text-slate-900 focus:ring-2 focus:ring-emerald-600 outline-none shadow-sm">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-slate-400 text-xs"></i>
                </div>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-800 min-w-[750px]">
                <thead class="bg-slate-900 text-white uppercase tracking-wider text-[11px]">
                    <tr>
                        <th class="py-3.5 px-4 text-center w-14 font-bold">NO</th>
                        <th class="py-3.5 px-4 w-16 text-center font-bold">FOTO</th>
                        <th class="py-3.5 px-4 font-bold">NAMA LENGKAP & GELAR</th>
                        <th class="py-3.5 px-4 font-bold">JABATAN PENGURUS</th>
                        <th class="py-3.5 px-4 font-bold">DIVISI / BIDANG</th>
                        <th class="py-3.5 px-4 text-center font-bold">URUTAN</th>
                        <th class="py-3.5 px-4 font-bold">KONTAK</th>
                        <th class="py-3.5 px-4 text-center w-28 font-bold">AKSI</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse($structures as $index => $s)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="py-3 px-4 text-center font-bold text-slate-500">{{ $structures->firstItem() + $index }}</td>
                            <td class="py-3 px-4 text-center">
                                <div class="w-10 h-10 rounded-full bg-slate-100 ring-1 ring-slate-300 overflow-hidden mx-auto shadow-sm">
                                    <img src="{{ $s->foto_url }}" alt="{{ $s->nama }}" class="w-full h-full object-cover">
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <div class="font-bold text-slate-900 text-sm">{{ $s->nama }}</div>
                                <div class="text-[10px] text-slate-400 font-semibold">{{ $s->periode ?? '2026 - 2031' }}</div>
                            </td>
                            <td class="py-3 px-4">
                                <span class="inline-block px-2.5 py-1 rounded-md bg-emerald-50 border border-emerald-200 text-emerald-800 font-bold text-xs">
                                    {{ $s->jabatan }}
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                <span class="text-xs font-semibold text-slate-700">
                                    {{ $s->divisi ?? '-' }}
                                </span>
                            </td>
                            <td class="py-3 px-4 text-center font-mono font-bold text-slate-800">
                                <span class="inline-block w-7 h-7 rounded-lg bg-slate-100 leading-7 text-center">
                                    {{ $s->urutan }}
                                </span>
                            </td>
                            <td class="py-3 px-4 text-slate-600 font-mono text-[11px]">
                                {{ $s->no_hp ?? ($s->email ?? '-') }}
                            </td>
                            <td class="py-3 px-4 text-center">
                                <div class="flex items-center justify-center gap-1.5">
                                    <button type="button" @click="openEdit({{ $s->id }})" class="p-2 rounded-lg bg-emerald-50 text-emerald-700 hover:bg-emerald-100 shadow-sm transition cursor-pointer" title="Edit Pengurus">
                                        <i class="fa-solid fa-pen text-xs"></i>
                                    </button>
                                    <form action="{{ route('admin.organization.destroy', $s->id) }}" method="POST" onsubmit="return confirm('Hapus pengurus {{ addslashes($s->nama) }}?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 shadow-sm transition cursor-pointer" title="Hapus">
                                            <i class="fa-solid fa-trash text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-12 text-center text-slate-400 font-medium">
                                Tidak ada data pengurus organisasi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($structures->hasPages())
            <div class="p-4 sm:p-5 border-t border-slate-200 bg-slate-50/50">
                {{ $structures->withQueryString()->links() }}
            </div>
        @endif

    </div>

    <!-- Modal Tambah Pengurus -->
    <div x-show="modalTambah" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/70 backdrop-blur-sm" @click.self="modalTambah = false">
        <div class="relative w-full max-w-lg bg-white rounded-3xl p-6 sm:p-8 shadow-2xl space-y-5" @click.away="modalTambah = false">
            <div class="flex items-center justify-between border-b border-slate-200 pb-3">
                <h3 class="text-base font-extrabold text-slate-900 flex items-center gap-2">
                    <i class="fa-solid fa-user-plus text-emerald-700"></i> Tambah Pengurus DPD APPSI
                </h3>
                <button type="button" @click="modalTambah = false" class="text-slate-400 hover:text-slate-600">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <form action="{{ route('admin.organization.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Nama Lengkap & Gelar *</label>
                    <input type="text" name="nama" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-xs font-semibold text-slate-900 focus:ring-2 focus:ring-emerald-600 outline-none shadow-sm" placeholder="Contoh: Wardoyo, S.I.Kom.">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Jabatan Resmi *</label>
                        <input type="text" name="jabatan" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-xs font-semibold text-slate-900 focus:ring-2 focus:ring-emerald-600 outline-none shadow-sm" placeholder="Contoh: KETUA BIDANG">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Divisi / Bidang</label>
                        <input type="text" name="divisi" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-xs font-semibold text-slate-900 focus:ring-2 focus:ring-emerald-600 outline-none shadow-sm" placeholder="Contoh: Organisasi dan OKK">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Urutan Tampil (No)</label>
                        <input type="number" name="urutan" value="1" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-xs font-semibold text-slate-900 focus:ring-2 focus:ring-emerald-600 outline-none shadow-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Periode</label>
                        <input type="text" name="periode" value="2026 - 2031" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-xs font-semibold text-slate-900 focus:ring-2 focus:ring-emerald-600 outline-none shadow-sm">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">No. WhatsApp / HP</label>
                        <input type="text" name="no_hp" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-xs font-semibold text-slate-900 focus:ring-2 focus:ring-emerald-600 outline-none shadow-sm" placeholder="0812-xxxx-xxxx">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Email</label>
                        <input type="email" name="email" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-xs font-semibold text-slate-900 focus:ring-2 focus:ring-emerald-600 outline-none shadow-sm" placeholder="nama@appsiba.or.id">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Foto Formal (Opsional)</label>
                    <input type="file" name="foto" accept="image/*" class="w-full px-3 py-2 rounded-xl border border-slate-300 text-xs font-semibold text-slate-900 file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-200">
                    <button type="button" @click="modalTambah = false" class="px-4 py-2 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-100 transition">Batal</button>
                    <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold text-white bg-emerald-700 hover:bg-emerald-800 shadow-sm transition">Simpan Pengurus</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Pengurus -->
    <div x-show="editModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/70 backdrop-blur-sm" @click.self="editModal = false">
        <div class="relative w-full max-w-lg bg-white rounded-3xl p-6 sm:p-8 shadow-2xl space-y-5" @click.away="editModal = false">
            <div class="flex items-center justify-between border-b border-slate-200 pb-3">
                <h3 class="text-base font-extrabold text-slate-900 flex items-center gap-2">
                    <i class="fa-solid fa-pen text-emerald-700"></i> Edit Pengurus DPD APPSI
                </h3>
                <button type="button" @click="editModal = false" class="text-slate-400 hover:text-slate-600">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <form id="editOrgForm" :action="'{{ url('admin/struktur-organisasi') }}/' + editForm.id" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Nama Lengkap & Gelar *</label>
                    <input type="text" name="nama" x-model="editForm.nama" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-xs font-semibold text-slate-900 focus:ring-2 focus:ring-emerald-600 outline-none shadow-sm">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Jabatan Resmi *</label>
                        <input type="text" name="jabatan" x-model="editForm.jabatan" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-xs font-semibold text-slate-900 focus:ring-2 focus:ring-emerald-600 outline-none shadow-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Divisi / Bidang</label>
                        <input type="text" name="divisi" x-model="editForm.divisi" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-xs font-semibold text-slate-900 focus:ring-2 focus:ring-emerald-600 outline-none shadow-sm">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Urutan Tampil (No)</label>
                        <input type="number" name="urutan" x-model="editForm.urutan" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-xs font-semibold text-slate-900 focus:ring-2 focus:ring-emerald-600 outline-none shadow-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Periode</label>
                        <input type="text" name="periode" x-model="editForm.periode" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-xs font-semibold text-slate-900 focus:ring-2 focus:ring-emerald-600 outline-none shadow-sm">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">No. WhatsApp / HP</label>
                        <input type="text" name="no_hp" x-model="editForm.no_hp" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-xs font-semibold text-slate-900 focus:ring-2 focus:ring-emerald-600 outline-none shadow-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Email</label>
                        <input type="email" name="email" x-model="editForm.email" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-xs font-semibold text-slate-900 focus:ring-2 focus:ring-emerald-600 outline-none shadow-sm">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Ganti Foto Formal (Opsional)</label>
                    <input type="file" name="foto" accept="image/*" class="w-full px-3 py-2 rounded-xl border border-slate-300 text-xs font-semibold text-slate-900 file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-200">
                    <button type="button" @click="editModal = false" class="px-4 py-2 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-100 transition">Batal</button>
                    <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold text-white bg-emerald-700 hover:bg-emerald-800 shadow-sm transition">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
