<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\MemberRegistration;
use Illuminate\Http\Request;

class MemberRegistrationController extends Controller
{
    public function index(Request $request)
    {
        $query = MemberRegistration::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nama_usaha', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%");
            });
        }

        $registrations = $query->latest()->paginate(15)->withQueryString();

        return view('admin.members.registrations', compact('registrations'));
    }

    public function show(MemberRegistration $registration)
    {
        return view('admin.members.registration_detail', compact('registration'));
    }

    public function approve(Request $request, MemberRegistration $registration)
    {
        // Generate next NPA
        $count = Member::count() + 1;
        $npa = 'DPD-BA-01.' . str_pad($count, 4, '0', STR_PAD_LEFT);

        Member::create([
            'nama' => $registration->nama,
            'nik' => $registration->nik,
            'nomor_anggota' => $npa,
            'nama_usaha' => $registration->nama_usaha,
            'jenis_usaha' => $registration->jenis_usaha,
            'bentuk_usaha' => $registration->bentuk_usaha,
            'lokasi_pasar' => $registration->lokasi_pasar,
            'blok_nomor' => $registration->blok_nomor,
            'no_hp' => $registration->no_hp,
            'email' => $registration->email,
            'alamat_domisili' => $registration->alamat_domisili,
            'foto' => 'assets/images/default-avatar-gray.png',
            'terdaftar_sejak' => now(),
            'status' => 'aktif',
            'catatan' => 'Diverifikasi dari pendaftaran online web appsiba.or.id',
        ]);

        $registration->update([
            'status' => 'disetujui',
            'catatan_admin' => $request->input('catatan_admin', 'Disetujui menjadi Anggota Resmi APPSI Banyuasin dengan NPA ' . $npa),
        ]);

        return redirect()->route('admin.registrations.index')->with('success', 'Pendaftaran pedagang disetujui! Anggota baru berhasil dibuat dengan NPA ' . $npa);
    }

    public function reject(Request $request, MemberRegistration $registration)
    {
        $registration->update([
            'status' => 'ditolak',
            'catatan_admin' => $request->input('catatan_admin', 'Data tidak sesuai persyaratan organisasi.'),
        ]);

        return redirect()->route('admin.registrations.index')->with('success', 'Permohonan pendaftaran telah ditolak.');
    }

    public function destroy(MemberRegistration $registration)
    {
        $registration->delete();
        return redirect()->route('admin.registrations.index')->with('success', 'Data pendaftaran berhasil dihapus.');
    }
}
