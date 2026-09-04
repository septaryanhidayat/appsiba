<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Setting;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $query = Member::query();

        if ($request->filled('jenis_usaha')) {
            $query->where('jenis_usaha', $request->jenis_usaha);
        }

        if ($request->filled('lokasi_pasar')) {
            $query->where('lokasi_pasar', $request->lokasi_pasar);
        }

        if ($request->filled('bentuk_usaha')) {
            $query->where('bentuk_usaha', $request->bentuk_usaha);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('nomor_anggota', 'like', "%{$search}%")
                    ->orWhere('nama_usaha', 'like', "%{$search}%")
                    ->orWhere('nik', 'like', "%{$search}%");
            });
        }

        $members = $query->latest()->paginate(15)->withQueryString();
        $commodities = Member::distinct()->pluck('jenis_usaha');
        $markets = Member::distinct()->pluck('lokasi_pasar');

        return view('admin.members.index', compact('members', 'commodities', 'markets'));
    }

    public function create()
    {
        // Auto-generate candidate NPA: DPD-BA-01.XXXX
        $count = Member::count() + 1;
        $nextNpa = 'DPD-BA-01.'.str_pad($count, 4, '0', STR_PAD_LEFT);

        return view('admin.members.create', compact('nextNpa'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'nullable|string|max:20',
            'nomor_anggota' => 'required|string|max:50|unique:members,nomor_anggota',
            'nama_usaha' => 'required|string|max:255',
            'jenis_usaha' => 'required|string|max:255',
            'bentuk_usaha' => 'required|string|max:100',
            'lokasi_pasar' => 'required|string|max:255',
            'blok_nomor' => 'nullable|string|max:100',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'alamat_domisili' => 'nullable|string',
            'foto' => 'nullable|image|max:3072',
            'status' => 'required|in:aktif,verifikasi,tidak_aktif',
            'catatan' => 'nullable|string',
        ]);

        $fotoPath = 'assets/images/default-avatar-gray.png';
        if ($request->hasFile('foto')) {
            $path = ImageService::uploadAndConvertToWebp($request->file('foto'), 'members', 'public', 82, 1000);
            $fotoPath = 'storage/'.$path;
        }

        Member::create(array_merge($validated, [
            'foto' => $fotoPath,
            'terdaftar_sejak' => now(),
        ]));

        return redirect()->route('admin.members.index')->with('success', 'Data pedagang pasar anggota APPSI berhasil ditambahkan!');
    }

    public function edit(Member $member)
    {
        return view('admin.members.edit', compact('member'));
    }

    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'nullable|string|max:20',
            'nomor_anggota' => 'required|string|max:50|unique:members,nomor_anggota,'.$member->id,
            'nama_usaha' => 'required|string|max:255',
            'jenis_usaha' => 'required|string|max:255',
            'bentuk_usaha' => 'required|string|max:100',
            'lokasi_pasar' => 'required|string|max:255',
            'blok_nomor' => 'nullable|string|max:100',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'alamat_domisili' => 'nullable|string',
            'foto' => 'nullable|image|max:3072',
            'status' => 'required|in:aktif,verifikasi,tidak_aktif',
            'catatan' => 'nullable|string',
        ]);

        if ($request->hasFile('foto')) {
            ImageService::delete($member->foto);
            $path = ImageService::uploadAndConvertToWebp($request->file('foto'), 'members', 'public', 82, 1000);
            $validated['foto'] = 'storage/'.$path;
        }

        $member->update($validated);

        return redirect()->route('admin.members.index')->with('success', 'Data pedagang pasar anggota APPSI berhasil diperbarui!');
    }

    public function destroy(Member $member)
    {
        ImageService::delete($member->foto);
        $member->delete();

        return redirect()->route('admin.members.index')->with('success', 'Data pedagang pasar berhasil dihapus.');
    }

    public function cetakKta(Member $member)
    {
        return view('admin.members.kta', compact('member'));
    }

    /**
     * Cetak Rekapitulasi Data Pedagang Pasar Resmi DPD APPSI
     */
    public function cetakRekap(Request $request)
    {
        $query = Member::query();

        if ($request->filled('jenis_usaha')) {
            $query->where('jenis_usaha', $request->jenis_usaha);
        }

        if ($request->filled('lokasi_pasar')) {
            $query->where('lokasi_pasar', $request->lokasi_pasar);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $members = $query->orderBy('lokasi_pasar', 'asc')->orderBy('nama', 'asc')->get();
        $settings = Setting::pluck('value', 'key');

        return view('admin.members.rekap', compact('members', 'settings'));
    }

    /**
     * Ubah visibilitas daftar direktori pedagang anggota di website publik
     */
    public function toggleVisibility(Request $request)
    {
        $current = Setting::get('tampilkan_daftar_anggota', '1');
        $new = $current === '0' ? '1' : '0';
        Setting::set('tampilkan_daftar_anggota', $new);
        Cache::forget('web_settings_global');

        $statusText = $new === '1' ? 'ditampilkan di website publik' : 'disembunyikan dari website publik (layanan pendaftaran & cek KTA tetap aktif)';

        return back()->with('success', "Visibilitas direktori pedagang berhasil diubah: data pedagang kini {$statusText}.");
    }
}
