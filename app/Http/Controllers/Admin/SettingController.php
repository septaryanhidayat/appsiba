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
            // 1. Identitas Organisasi
            'nama_organisasi' => 'required|string|max:255',
            'singkatan' => 'required|string|max:100',
            'periode' => 'nullable|string|max:50',

            // 2. Kontak & Sekretariat
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:100',
            'whatsapp' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|string|max:255',

            // 3. Pimpinan & Dokumen Resmi
            'nama_ketua' => 'required|string|max:255',
            'jabatan_ketua' => 'required|string|max:255',
            'nama_sekretaris' => 'required|string|max:255',
            'jabatan_sekretaris' => 'required|string|max:255',
            'nama_bendahara' => 'nullable|string|max:255',

            // 4. Profil, Visi, Misi & Sambutan
            'sambutan_ketua' => 'nullable|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'tentang_organisasi' => 'nullable|string',

            // 5. SEO & Metadata Sosial Media
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:500',
            'seo_keywords' => 'nullable|string|max:500',

            // 6. Kustomisasi Teks Halaman Beranda (Home)
            'hero_badge' => 'nullable|string|max:100',
            'hero_title' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string|max:500',
            'hero_tagline' => 'nullable|string|max:100',
            'home_bersatu_title' => 'nullable|string|max:255',
            'home_bersatu_desc' => 'nullable|string|max:500',

            // 7. Visibilitas Direktori Publik
            'tampilkan_daftar_anggota' => 'nullable|in:0,1',

            // 8. Berkas & Media Aset
            'logo' => 'nullable|file|mimes:jpg,jpeg,png,webp,svg|max:4096',
            'favicon' => 'nullable|file|mimes:ico,png,webp,svg|max:2048',
            'og_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'hero_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'foto_ketua_profil' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'foto_ketua_semangat' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        // Simpan semua text field ke tabel settings
        $textFields = [
            'nama_organisasi', 'singkatan', 'periode',
            'alamat', 'telepon', 'whatsapp', 'email', 'website',
            'nama_ketua', 'jabatan_ketua', 'nama_sekretaris', 'jabatan_sekretaris', 'nama_bendahara',
            'sambutan_ketua', 'visi', 'misi', 'tentang_organisasi',
            'seo_title', 'seo_description', 'seo_keywords',
            'hero_badge', 'hero_title', 'hero_subtitle', 'hero_tagline',
            'home_bersatu_title', 'home_bersatu_desc',
            'tampilkan_daftar_anggota',
        ];

        foreach ($textFields as $field) {
            if ($request->has($field)) {
                Setting::set($field, $request->input($field));
            }
        }

        // Upload Logo
        if ($request->hasFile('logo')) {
            $oldLogo = Setting::get('logo');
            if ($oldLogo) {
                ImageService::delete($oldLogo);
            }
            $logoPath = ImageService::uploadAndConvertToWebp($request->file('logo'), 'settings', 'public', 90, 800);
            Setting::set('logo', $logoPath);
        }

        // Upload Favicon
        if ($request->hasFile('favicon')) {
            $oldFavicon = Setting::get('favicon');
            if ($oldFavicon) {
                ImageService::delete($oldFavicon);
            }
            $faviconPath = $request->file('favicon')->store('settings', 'public');
            Setting::set('favicon', $faviconPath);
        }

        // Upload Open Graph / Social Media Preview Image
        if ($request->hasFile('og_image')) {
            $oldOg = Setting::get('og_image');
            if ($oldOg) {
                ImageService::delete($oldOg);
            }
            $ogPath = ImageService::uploadAndConvertToWebp($request->file('og_image'), 'settings', 'public', 85, 1200);
            Setting::set('og_image', $ogPath);
        }

        // Upload Hero Image (Foto Cutout Ketua Beranda)
        if ($request->hasFile('hero_image')) {
            $oldHero = Setting::get('hero_image');
            if ($oldHero) {
                ImageService::delete($oldHero);
            }
            $heroPath = ImageService::uploadAndConvertToWebp($request->file('hero_image'), 'settings', 'public', 88, 1200);
            Setting::set('hero_image', $heroPath);
        }

        // Upload Foto Ketua Profil (Halaman Tentang Kami)
        if ($request->hasFile('foto_ketua_profil')) {
            $oldProfil = Setting::get('foto_ketua_profil');
            if ($oldProfil) {
                ImageService::delete($oldProfil);
            }
            $profilPath = ImageService::uploadAndConvertToWebp($request->file('foto_ketua_profil'), 'settings', 'public', 85, 1000);
            Setting::set('foto_ketua_profil', $profilPath);
        }

        // Upload Foto Ketua Semangat (Bagian Keanggotaan Beranda)
        if ($request->hasFile('foto_ketua_semangat')) {
            $oldSemangat = Setting::get('foto_ketua_semangat');
            if ($oldSemangat) {
                ImageService::delete($oldSemangat);
            }
            $semangatPath = ImageService::uploadAndConvertToWebp($request->file('foto_ketua_semangat'), 'settings', 'public', 85, 1000);
            Setting::set('foto_ketua_semangat', $semangatPath);
        }

        // Invalidate global cache agar seluruh halaman publik langsung terupdate instan
        Cache::forget('web_settings_global');

        return redirect()->back()->with('success', 'Pengaturan website, profil DPD, aset brand & SEO berhasil diperbarui dan langsung aktif di website publik!');
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
