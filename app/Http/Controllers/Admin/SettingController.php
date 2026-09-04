<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'nama_organisasi' => 'required|string|max:255',
            'singkatan' => 'required|string|max:100',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:100',
            'whatsapp' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|string|max:255',
            'periode' => 'nullable|string|max:50',
            'nama_ketua' => 'required|string|max:255',
            'jabatan_ketua' => 'required|string|max:255',
            'nama_sekretaris' => 'required|string|max:255',
            'jabatan_sekretaris' => 'required|string|max:255',
            'nama_bendahara' => 'nullable|string|max:255',
            'sambutan_ketua' => 'nullable|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'tentang_organisasi' => 'nullable|string',
            'tampilkan_daftar_anggota' => 'nullable|in:0,1',
        ]);

        foreach ($validated as $key => $value) {
            Setting::set($key, $value);
        }

        if ($request->hasFile('logo')) {
            $request->validate([
                'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            ]);
            $oldLogo = Setting::get('logo');
            if ($oldLogo) {
                ImageService::delete($oldLogo);
            }
            $logoPath = ImageService::uploadAndConvertToWebp($request->file('logo'), 'settings', 'public', 90, 600);
            Setting::set('logo', 'storage/'.$logoPath);
        }

        Cache::forget('web_settings_global');

        return redirect()->back()->with('success', 'Pengaturan profil organisasi dan identitas digital DPD APPSI Banyuasin berhasil diperbarui.');
    }

    public function passwordForm()
    {
        return view('admin.settings.password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'current_password.required' => 'Kata sandi saat ini wajib diisi.',
            'current_password.current_password' => 'Kata sandi saat ini yang Anda masukkan salah.',
            'password.required' => 'Kata sandi baru wajib diisi.',
            'password.min' => 'Kata sandi baru minimal harus 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi baru tidak cocok.',
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Kata sandi akun administrator berhasil diubah.');
    }
}
