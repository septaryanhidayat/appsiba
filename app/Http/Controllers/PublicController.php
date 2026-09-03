<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Inbox;
use App\Models\Letter;
use App\Models\Meeting;
use App\Models\Member;
use App\Models\MemberRegistration;
use App\Models\OrganizationStructure;
use App\Models\Post;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class PublicController extends Controller
{
    /**
     * Halaman Utama / Beranda APPSI Banyuasin
     */
    public function index()
    {
        $posts = Post::where('status', 'published')
            ->latest('published_at')
            ->take(3)
            ->get();

        $meetings = Meeting::latest('tanggal')
            ->take(2)
            ->get();

        $galleries = Gallery::latest('tanggal_kegiatan')
            ->take(4)
            ->get();

        $stats = [
            'total_anggota' => Member::where('status', 'aktif')->count(),
            'total_pasar' => Member::distinct('lokasi_pasar')->count('lokasi_pasar') ?: 5,
            'total_komoditas' => Member::distinct('jenis_usaha')->count('jenis_usaha') ?: 7,
            'total_berita' => Post::where('status', 'published')->count(),
        ];

        $ketua = OrganizationStructure::where('jabatan', 'like', '%Ketua%')->first();

        return view('public.home', compact('posts', 'meetings', 'galleries', 'stats', 'ketua'));
    }

    /**
     * Struktur Organisasi DPD APPSI Banyuasin (Adopsi appsi.id)
     */
    public function struktur()
    {
        $structures = OrganizationStructure::orderBy('urutan', 'asc')->get();

        $ketua = $structures->firstWhere('jabatan', 'Ketua DPD') ?? $structures->first();
        $pimpinanHarian = $structures->where('divisi', 'Pimpinan Harian')->filter(fn($item) => $item->id !== ($ketua->id ?? 0));
        $sekretariat = $structures->where('divisi', 'Sekretariat');
        $kebendaharaan = $structures->where('divisi', 'Kebendaharaan');
        $bidang = $structures->filter(fn($item) => !in_array($item->divisi, ['Pimpinan Harian', 'Sekretariat', 'Kebendaharaan', 'Komisariat Pasar']));
        $komisariat = $structures->where('divisi', 'Komisariat Pasar');

        return view('public.struktur', compact('structures', 'ketua', 'pimpinanHarian', 'sekretariat', 'kebendaharaan', 'bidang', 'komisariat'));
    }

    /**
     * Berita & Kabar Pasar
     */
    public function berita(Request $request)
    {
        $query = Post::where('status', 'published');

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('ringkasan', 'like', "%{$search}%")
                  ->orWhere('konten', 'like', "%{$search}%");
            });
        }

        $posts = $query->latest('published_at')->paginate(9)->withQueryString();
        $categories = Post::where('status', 'published')->distinct()->pluck('kategori');

        return view('public.berita.index', compact('posts', 'categories'));
    }

    /**
     * Detail Berita Pasar
     */
    public function beritaDetail($slug)
    {
        $post = Post::where('slug', $slug)->where('status', 'published')->firstOrFail();
        $post->increment('views_count');

        $relatedPosts = Post::where('status', 'published')
            ->where('id', '!=', $post->id)
            ->where('kategori', $post->kategori)
            ->latest('published_at')
            ->take(3)
            ->get();

        if ($relatedPosts->isEmpty()) {
            $relatedPosts = Post::where('status', 'published')
                ->where('id', '!=', $post->id)
                ->latest('published_at')
                ->take(3)
                ->get();
        }

        return view('public.berita.detail', compact('post', 'relatedPosts'));
    }

    /**
     * Galeri Kegiatan Pasar
     */
    public function galeri(Request $request)
    {
        $query = Gallery::query();

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where('judul', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
        }

        $galleries = $query->latest('tanggal_kegiatan')->paginate(12)->withQueryString();
        $categories = Gallery::distinct()->pluck('kategori');

        return view('public.galeri', compact('galleries', 'categories'));
    }

    /**
     * Direktori Keanggotaan Pedagang Pasar APPSI Banyuasin
     */
    public function keanggotaan(Request $request)
    {
        $query = Member::where('status', 'aktif');

        if ($request->filled('jenis_usaha')) {
            $query->where('jenis_usaha', $request->jenis_usaha);
        }

        if ($request->filled('lokasi_pasar')) {
            $query->where('lokasi_pasar', $request->lokasi_pasar);
        }

        if ($request->filled('bentuk_usaha')) {
            $query->where('bentuk_usaha', $request->bentuk_usaha);
        }

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nama_usaha', 'like', "%{$search}%")
                  ->orWhere('nomor_anggota', 'like', "%{$search}%");
            });
        }

        $members = $query->orderBy('nama', 'asc')->paginate(12)->withQueryString();

        $commodities = Member::distinct()->pluck('jenis_usaha');
        $markets = Member::distinct()->pluck('lokasi_pasar');

        return view('public.keanggotaan.index', compact('members', 'commodities', 'markets'));
    }

    /**
     * Formulir Pendaftaran Anggota Pedagang Baru Online
     */
    public function daftarKeanggotaan()
    {
        $markets = [
            'Pasar Pangkalan Balai (Banyuasin III)',
            'Pasar Betung',
            'Pasar Mariana (Banyuasin I)',
            'Pasar Sungsang (Banyuasin II)',
            'Pasar Sukajadi (Talang Kelapa)',
            'Pasar Makarti Jaya',
            'Pasar Muara Telang',
            'Pasar Sungai Lilin / Banyuasin',
            'Pasar Rambutan',
            'Pasar Tradisional Lainnya di Kab. Banyuasin',
        ];

        $commodities = [
            'Sembako & Kebutuhan Pokok',
            'Sayur, Buah & Hasil Bumi',
            'Daging, Unggas & Ikan Segar',
            'Pakaian, Konveksi & Tekstil',
            'Kuliner & Jajanan Tradisional',
            'Kelontong & Aneka Plastik',
            'Elektronik, Servis & Aneka Jasa',
            'Perhiasan, Emas & Aksesoris',
            'Lain-lain / Serba Usaha',
        ];

        return view('public.keanggotaan.daftar', compact('markets', 'commodities'));
    }

    /**
     * Simpan Pendaftaran Anggota Pedagang Baru
     */
    public function storeDaftarKeanggotaan(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:20',
            'no_hp' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'nama_usaha' => 'required|string|max:255',
            'jenis_usaha' => 'required|string|max:255',
            'bentuk_usaha' => 'required|string|max:100',
            'lokasi_pasar' => 'required|string|max:255',
            'blok_nomor' => 'nullable|string|max:100',
            'alamat_domisili' => 'required|string',
            'foto_ktp' => 'nullable|image|max:3072',
            'foto_usaha' => 'nullable|image|max:3072',
        ]);

        $fotoKtpPath = null;
        if ($request->hasFile('foto_ktp')) {
            $fotoKtpPath = $request->file('foto_ktp')->store('registrations/ktp', 'public');
        }

        $fotoUsahaPath = null;
        if ($request->hasFile('foto_usaha')) {
            $fotoUsahaPath = $request->file('foto_usaha')->store('registrations/usaha', 'public');
        }

        MemberRegistration::create([
            'nama' => strip_tags($validated['nama']),
            'nik' => strip_tags($validated['nik']),
            'no_hp' => strip_tags($validated['no_hp']),
            'email' => $validated['email'] ? strip_tags($validated['email']) : null,
            'nama_usaha' => strip_tags($validated['nama_usaha']),
            'jenis_usaha' => strip_tags($validated['jenis_usaha']),
            'bentuk_usaha' => strip_tags($validated['bentuk_usaha']),
            'lokasi_pasar' => strip_tags($validated['lokasi_pasar']),
            'blok_nomor' => $validated['blok_nomor'] ? strip_tags($validated['blok_nomor']) : null,
            'alamat_domisili' => strip_tags($validated['alamat_domisili']),
            'foto_ktp' => $fotoKtpPath,
            'foto_usaha' => $fotoUsahaPath,
            'status' => 'menunggu_verifikasi',
        ]);

        return back()->with('success', 'Terima kasih! Formulir pendaftaran keanggotaan APPSI Kabupaten Banyuasin berhasil terkirim. Pengurus DPD akan memverifikasi data Anda.');
    }

    /**
     * Tentang Kami / Profil APPSI Banyuasin
     */
    public function tentangKami()
    {
        $settings = Setting::pluck('value', 'key');
        $ketua = OrganizationStructure::where('jabatan', 'like', '%Ketua%')->first();

        return view('public.tentang-kami', compact('settings', 'ketua'));
    }

    /**
     * Buku Tamu & Aspirasi Publik / Pedagang
     */
    public function storeBukuTamu(Request $request)
    {
        $key = 'inbox-submit:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            return back()->with('error', "Terlalu banyak pesan terkirim. Silakan tunggu {$seconds} detik lagi.")->withInput();
        }
        RateLimiter::hit($key, 120);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'instansi' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'telepon' => 'nullable|string|max:255',
            'tujuan' => 'required|string|max:255',
            'keperluan' => 'required|string|max:255',
            'pesan' => 'required|string|max:2000',
        ]);

        Inbox::create([
            'tanggal' => now(),
            'nama' => strip_tags($validated['nama']),
            'instansi' => $validated['instansi'] ? strip_tags($validated['instansi']) : 'Pedagang / Masyarakat',
            'email' => $validated['email'] ? strip_tags($validated['email']) : null,
            'telepon' => $validated['telepon'] ? strip_tags($validated['telepon']) : null,
            'tujuan' => strip_tags($validated['tujuan']),
            'keperluan' => strip_tags($validated['keperluan']),
            'pesan' => strip_tags($validated['pesan']),
            'status' => 'baru',
        ]);

        return back()->with('success', 'Pesan aspirasi Anda telah berhasil terkirim kepada Pengurus DPD APPSI Kabupaten Banyuasin.');
    }

    /**
     * Verifikasi Surat / Dokumen Resmi via QR Code
     */
    public function verifikasiSurat($hash)
    {
        $letter = Letter::where('hash_keabsahan', $hash)
            ->orWhere('uuid', $hash)
            ->orWhere('id', $hash)
            ->first();

        return view('public.surat.verifikasi', compact('letter', 'hash'));
    }
}
