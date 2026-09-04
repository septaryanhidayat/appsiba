<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Letter;
use App\Models\Member;
use App\Models\Setting;
use Illuminate\Http\Request;

class LetterController extends Controller
{
    public function index(Request $request)
    {
        $query = Letter::query();

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('nomor_surat', 'like', "%{$s}%")
                    ->orWhere('tujuan', 'like', "%{$s}%")
                    ->orWhere('keperluan', 'like', "%{$s}%")
                    ->orWhere('jenis_surat', 'like', "%{$s}%")
                    ->orWhere('nama_pejabat', 'like', "%{$s}%");
            });
        }

        if ($request->filled('jenis')) {
            $query->where('jenis_surat', $request->jenis);
        }

        $letters = $query->latest('tanggal')->paginate(15)->withQueryString();

        return view('admin.letters.index', compact('letters'));
    }

    public function create(Request $request)
    {
        $jenis = $request->get('jenis', 'SURAT BIASA');
        $nomorSurat = Letter::generateNomorSurat($jenis);
        $defaultKetua = Setting::get('nama_ketua', 'H. Gusra Yetri, SH');
        $defaultSekretaris = Setting::get('nama_sekretaris', 'M. Rian Pratama, S.E.');
        $members = Member::where('status', 'aktif')->orderBy('nama')->get();

        return view('admin.letters.create', compact('jenis', 'nomorSurat', 'defaultKetua', 'defaultSekretaris', 'members'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required|string|unique:letters,nomor_surat',
            'tanggal' => 'required|date',
            'jenis_surat' => 'required|string',
            'tujuan' => 'required|string|max:255',
            'keperluan' => 'required|string|max:255',
            'perihal' => 'nullable|string|max:255',
            'tempat_tujuan' => 'nullable|string|max:255',
            'nama_pejabat' => 'nullable|string|max:255',
            'jabatan_pejabat' => 'nullable|string|max:255',
            'alamat_tujuan' => 'nullable|string|max:255',
            'lokasi' => 'nullable|string|max:255',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date',
            'lampiran' => 'nullable|string|max:255',
            'tembusan' => 'nullable|string',
            'nama_penandatangan' => 'required|string|max:255',
            'jabatan_penandatangan' => 'required|string|max:255',
            'nama_sekretaris' => 'nullable|string|max:255',
            'jabatan_sekretaris' => 'nullable|string|max:255',
            'isi_surat' => 'nullable|string',
        ]);

        $letter = Letter::create($validated);

        return redirect()->route('admin.letters.index')->with('success', "Surat resmi {$letter->nomor_surat} berhasil diterbitkan.");
    }

    public function show(Letter $letter)
    {
        $settings = Setting::pluck('value', 'key');

        return view('admin.letters.print', compact('letter', 'settings'));
    }

    public function edit(Letter $letter)
    {
        $defaultKetua = Setting::get('nama_ketua', 'H. Gusra Yetri, SH');
        $defaultSekretaris = Setting::get('nama_sekretaris', 'M. Rian Pratama, S.E.');
        $members = Member::where('status', 'aktif')->orderBy('nama')->get();

        return view('admin.letters.edit', compact('letter', 'defaultKetua', 'defaultSekretaris', 'members'));
    }

    public function update(Request $request, Letter $letter)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required|string|unique:letters,nomor_surat,'.$letter->id,
            'tanggal' => 'required|date',
            'jenis_surat' => 'required|string',
            'tujuan' => 'required|string|max:255',
            'keperluan' => 'required|string|max:255',
            'perihal' => 'nullable|string|max:255',
            'tempat_tujuan' => 'nullable|string|max:255',
            'nama_pejabat' => 'nullable|string|max:255',
            'jabatan_pejabat' => 'nullable|string|max:255',
            'alamat_tujuan' => 'nullable|string|max:255',
            'lokasi' => 'nullable|string|max:255',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date',
            'lampiran' => 'nullable|string|max:255',
            'tembusan' => 'nullable|string',
            'nama_penandatangan' => 'required|string|max:255',
            'jabatan_penandatangan' => 'required|string|max:255',
            'nama_sekretaris' => 'nullable|string|max:255',
            'jabatan_sekretaris' => 'nullable|string|max:255',
            'isi_surat' => 'nullable|string',
        ]);

        $letter->update($validated);

        return redirect()->route('admin.letters.index')->with('success', "Surat resmi {$letter->nomor_surat} berhasil diperbarui.");
    }

    public function destroy(Letter $letter)
    {
        $letter->delete();

        return redirect()->route('admin.letters.index')->with('success', 'Surat keluar berhasil dihapus.');
    }
}
