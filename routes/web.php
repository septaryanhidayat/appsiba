<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DownloadDocumentController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\InboxController;
use App\Http\Controllers\Admin\IncomingLetterController;
use App\Http\Controllers\Admin\LetterController;
use App\Http\Controllers\Admin\MeetingController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\MemberRegistrationController;
use App\Http\Controllers\Admin\OrganizationController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Portal Routes (APPSI Banyuasin - appsiba.or.id)
|--------------------------------------------------------------------------
*/
Route::get('/', [PublicController::class, 'index'])->name('home');

// Struktur Organisasi (adopsi appsi.id)
Route::get('/struktur', [PublicController::class, 'struktur'])->name('organization.public');
Route::get('/struktur-organisasi', [PublicController::class, 'struktur']);

// Berita & Kabar Pasar
Route::get('/berita', [PublicController::class, 'berita'])->name('news.index');
Route::get('/news', [PublicController::class, 'berita']);
Route::get('/berita/{slug}', [PublicController::class, 'beritaDetail'])->name('news.show');
Route::get('/news/{slug}', [PublicController::class, 'beritaDetail']);

// Galeri Kegiatan Pasar
Route::get('/galeri', [PublicController::class, 'galeri'])->name('gallery.public');

// Program Kerja & 5 Pilar
Route::get('/program-kerja', [PublicController::class, 'programKerja'])->name('programs.public');
Route::get('/program', [PublicController::class, 'programKerja']);

// Pusat Unduhan Dokumen Publik
Route::get('/unduhan', [PublicController::class, 'unduhan'])->name('downloads.public');
Route::get('/download', [PublicController::class, 'unduhan']);
Route::get('/unduhan/{id}/download', [PublicController::class, 'downloadDocument'])->name('downloads.file');

// Tanya Jawab / FAQ
Route::get('/faq', [PublicController::class, 'faq'])->name('faq.public');

// Kontak & Sekretariat Resmi
Route::get('/kontak', [PublicController::class, 'kontak'])->name('contact.public');

// Direktori & Pendaftaran Keanggotaan Pedagang Pasar
Route::get('/keanggotaan', [PublicController::class, 'keanggotaan'])->name('members.public');
Route::get('/anggota', [PublicController::class, 'keanggotaan']);
Route::get('/keanggotaan/cek', [PublicController::class, 'cekKta'])->name('members.check');
Route::get('/cek-kta', [PublicController::class, 'cekKta']);
Route::get('/keanggotaan/daftar', [PublicController::class, 'daftarKeanggotaan'])->name('members.register');
Route::post('/keanggotaan/daftar', [PublicController::class, 'storeDaftarKeanggotaan'])->name('members.register.store')->middleware('throttle:10,1');

// Tentang APPSI
Route::get('/tentang-kami', [PublicController::class, 'tentangKami'])->name('about.public');

// Buku Tamu & Aspirasi Publik / Pedagang
Route::post('/buku-tamu', [PublicController::class, 'storeBukuTamu'])->name('inbox.store')->middleware('throttle:6,1');
Route::post('/kontak/kirim', [PublicController::class, 'storeBukuTamu'])->middleware('throttle:6,1');

// Verifikasi Keabsahan Surat Resmi via QR Code atau Nomor Surat
Route::get('/verifikasi-surat', [PublicController::class, 'verifikasiSurat'])->name('letter.verify.index');
Route::get('/surat/verifikasi/{hash?}', [PublicController::class, 'verifikasiSurat'])->name('letter.verify');
Route::get('/verifikasi-surat/{hash}', [PublicController::class, 'verifikasiSurat']);

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post')->middleware('throttle:5,1');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Executive Admin MIS (Management Information System)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    // Dashboard Utama
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Modul Keanggotaan Pedagang Pasar
    Route::get('/anggota', [MemberController::class, 'index'])->name('members.index');
    Route::get('/anggota/rekap-cetak', [MemberController::class, 'cetakRekap'])->name('members.rekap');
    Route::get('/anggota/tambah', [MemberController::class, 'create'])->name('members.create');
    Route::post('/anggota', [MemberController::class, 'store'])->name('members.store');
    Route::get('/anggota/{member}/edit', [MemberController::class, 'edit'])->name('members.edit');
    Route::put('/anggota/{member}', [MemberController::class, 'update'])->name('members.update');
    Route::delete('/anggota/{member}', [MemberController::class, 'destroy'])->name('members.destroy');
    Route::get('/anggota/{member}/kta', [MemberController::class, 'cetakKta'])->name('members.kta');
    Route::post('/anggota/toggle-visibilitas', [MemberController::class, 'toggleVisibility'])->name('members.toggle-visibility');

    // Modul Pendaftaran Anggota Baru Online (Verifikasi & Persetujuan)
    Route::get('/pendaftaran-anggota', [MemberRegistrationController::class, 'index'])->name('registrations.index');
    Route::get('/pendaftaran-anggota/{registration}', [MemberRegistrationController::class, 'show'])->name('registrations.show');
    Route::post('/pendaftaran-anggota/{registration}/approve', [MemberRegistrationController::class, 'approve'])->name('registrations.approve');
    Route::post('/pendaftaran-anggota/{registration}/reject', [MemberRegistrationController::class, 'reject'])->name('registrations.reject');
    Route::delete('/pendaftaran-anggota/{registration}', [MemberRegistrationController::class, 'destroy'])->name('registrations.destroy');

    // Modul CMS Berita Pasar
    Route::get('/berita/publish', [PostController::class, 'publishIndex'])->name('posts.publish');
    Route::get('/berita/draft', [PostController::class, 'draftIndex'])->name('posts.draft');
    Route::get('/berita/buat', [PostController::class, 'create'])->name('posts.create');
    Route::post('/berita', [PostController::class, 'store'])->name('posts.store');
    Route::get('/berita/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/berita/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/berita/{id}', [PostController::class, 'destroy'])->name('posts.destroy');

    // Modul Galeri Dokumentasi Pasar
    Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery.index');
    Route::post('/galeri', [GalleryController::class, 'store'])->name('gallery.store');
    Route::put('/galeri/{id}', [GalleryController::class, 'update'])->name('gallery.update');
    Route::delete('/galeri/{id}', [GalleryController::class, 'destroy'])->name('gallery.destroy');

    // Modul Generator Surat Keluar Resmi (KOP & QR Code)
    Route::get('/surat-keluar', [LetterController::class, 'index'])->name('letters.index');
    Route::get('/surat-keluar/buat', [LetterController::class, 'create'])->name('letters.create');
    Route::post('/surat-keluar', [LetterController::class, 'store'])->name('letters.store');
    Route::get('/surat-keluar/{letter}', [LetterController::class, 'show'])->name('letters.show');
    Route::get('/surat-keluar/{letter}/cetak', [LetterController::class, 'show'])->name('letters.print');
    Route::get('/surat-keluar/{letter}/edit', [LetterController::class, 'edit'])->name('letters.edit');
    Route::put('/surat-keluar/{letter}', [LetterController::class, 'update'])->name('letters.update');
    Route::delete('/surat-keluar/{letter}', [LetterController::class, 'destroy'])->name('letters.destroy');

    // Modul Arsip Surat Masuk
    Route::get('/surat-masuk', [IncomingLetterController::class, 'index'])->name('incoming-letters.index');
    Route::post('/surat-masuk', [IncomingLetterController::class, 'store'])->name('incoming-letters.store');
    Route::put('/surat-masuk/{id}', [IncomingLetterController::class, 'update'])->name('incoming-letters.update');
    Route::delete('/surat-masuk/{id}', [IncomingLetterController::class, 'destroy'])->name('incoming-letters.destroy');

    // Modul Agenda & Notulen Rapat Pasar
    Route::get('/notulen-rapat', [MeetingController::class, 'index'])->name('meetings.index');
    Route::get('/notulen-rapat/tambah', [MeetingController::class, 'create'])->name('meetings.create');
    Route::post('/notulen-rapat', [MeetingController::class, 'store'])->name('meetings.store');
    Route::get('/notulen-rapat/{meeting}', [MeetingController::class, 'show'])->name('meetings.show');
    Route::get('/notulen-rapat/{meeting}/edit', [MeetingController::class, 'edit'])->name('meetings.edit');
    Route::put('/notulen-rapat/{meeting}', [MeetingController::class, 'update'])->name('meetings.update');
    Route::delete('/notulen-rapat/{meeting}', [MeetingController::class, 'destroy'])->name('meetings.destroy');

    // Modul Aspirasi & Buku Tamu Masuk
    Route::get('/buku-tamu', [InboxController::class, 'index'])->name('inbox.index');
    Route::put('/buku-tamu/{id}', [InboxController::class, 'update'])->name('inbox.update');
    Route::delete('/buku-tamu/{id}', [InboxController::class, 'destroy'])->name('inbox.destroy');

    // Modul Susunan Pengurus DPD
    Route::get('/struktur-organisasi', [OrganizationController::class, 'index'])->name('organization.index');
    Route::post('/struktur-organisasi', [OrganizationController::class, 'store'])->name('organization.store');
    Route::put('/struktur-organisasi/{id}', [OrganizationController::class, 'update'])->name('organization.update');
    Route::delete('/struktur-organisasi/{id}', [OrganizationController::class, 'destroy'])->name('organization.destroy');

    // Modul Pusat Unduhan & Berkas Dokumen Resmi
    Route::get('/unduhan', [DownloadDocumentController::class, 'index'])->name('downloads.index');
    Route::post('/unduhan', [DownloadDocumentController::class, 'store'])->name('downloads.store');
    Route::put('/unduhan/{id}', [DownloadDocumentController::class, 'update'])->name('downloads.update');
    Route::delete('/unduhan/{id}', [DownloadDocumentController::class, 'destroy'])->name('downloads.destroy');
    Route::get('/unduhan/{id}/download', [DownloadDocumentController::class, 'download'])->name('downloads.download');

    // Modul Pengaturan & Profil
    Route::get('/pengaturan', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/pengaturan', [SettingController::class, 'update'])->name('settings.update');
    Route::get('/pengaturan/ganti-password', [SettingController::class, 'passwordForm'])->name('settings.password');
    Route::put('/pengaturan/ganti-password', [SettingController::class, 'updatePassword'])->name('settings.password.update');
});
