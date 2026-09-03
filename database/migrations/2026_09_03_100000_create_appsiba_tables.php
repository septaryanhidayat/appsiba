<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Members Table (Anggota Pedagang Pasar APPSI Banyuasin)
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nik', 20)->nullable();
            $table->string('nomor_anggota')->unique()->nullable(); // NPA DPD-BA-01.XXXX
            $table->string('nama_usaha'); // Contoh: Toko Sembako Berkah, Kios Daging Segar Barokah
            $table->string('jenis_usaha'); // Sembako & Kebutuhan Pokok, Sayur & Buah, Daging & Ikan Segar, Pakaian/Konveksi, Kuliner/Makanan, dsb.
            $table->string('bentuk_usaha')->default('Kios'); // Kios, Los, Lapak / Kaki Lima, Ruko, Distributor / Agen
            $table->string('lokasi_pasar')->default('Pasar Pangkalan Balai'); // Pasar Pangkalan Balai, Pasar Betung, Pasar Mariana, dsb.
            $table->string('blok_nomor')->nullable(); // Blok A No. 15
            $table->string('no_hp')->nullable();
            $table->string('email')->nullable();
            $table->text('alamat_domisili')->nullable();
            $table->string('foto')->nullable();
            $table->string('foto_usaha')->nullable();
            $table->date('terdaftar_sejak')->nullable();
            $table->enum('status', ['aktif', 'verifikasi', 'tidak_aktif'])->default('aktif');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });

        // 2. Member Online Registrations Table (Pendaftaran Anggota Pedagang Baru Mandiri)
        Schema::create('member_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nik', 20);
            $table->string('no_hp');
            $table->string('email')->nullable();
            $table->string('nama_usaha');
            $table->string('jenis_usaha');
            $table->string('bentuk_usaha')->default('Kios');
            $table->string('lokasi_pasar');
            $table->string('blok_nomor')->nullable();
            $table->text('alamat_domisili');
            $table->string('foto_ktp')->nullable();
            $table->string('foto_usaha')->nullable();
            $table->enum('status', ['menunggu_verifikasi', 'disetujui', 'ditolak'])->default('menunggu_verifikasi');
            $table->text('catatan_admin')->nullable();
            $table->timestamps();
        });

        // 3. Organization Structure Table (Pengurus DPD APPSI Banyuasin)
        Schema::create('organization_structures', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('jabatan'); // Ketua DPD, Sekretaris, Bendahara, Koordinator Bidang, dsb.
            $table->string('divisi')->nullable(); // Pimpinan Harian, Bidang Advokasi, Bidang Kemitraan & Permodalan, dsb.
            $table->integer('urutan')->default(0);
            $table->string('periode')->default('2024 - 2029');
            $table->string('foto')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });

        // 4. Posts / News Table (Kabar Pasar & Berita APPSI)
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->string('kategori')->default('Kegiatan Pasar');
            $table->string('penulis')->default('H. Gusra Yetri, SH');
            $table->text('ringkasan')->nullable();
            $table->longText('konten');
            $table->string('gambar')->nullable();
            $table->enum('status', ['draft', 'published'])->default('published');
            $table->integer('views_count')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });

        // 5. Galleries Table (Dokumentasi Kegiatan Pasar)
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('foto');
            $table->string('kategori')->default('Kegiatan');
            $table->date('tanggal_kegiatan')->nullable();
            $table->timestamps();
        });

        // 6. Letters Table (Surat Keluar Resmi ber-QR Code & KOP APPSI Banyuasin)
        Schema::create('letters', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->nullable();
            $table->string('nomor_surat')->unique();
            $table->date('tanggal');
            $table->string('jenis_surat')->default('SURAT BIASA'); // SURAT BIASA, REKOMENDASI USAHA, AUDIENSI, PEMBERITAHUAN, SURAT TUGAS
            $table->string('tujuan');
            $table->string('keperluan');
            $table->string('perihal')->nullable();
            $table->string('tempat_tujuan')->nullable();
            $table->string('nama_pejabat')->nullable();
            $table->string('jabatan_pejabat')->nullable();
            $table->string('alamat_tujuan')->nullable();
            $table->string('lokasi')->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->string('lampiran')->nullable();
            $table->text('tembusan')->nullable();
            $table->string('nama_penandatangan')->default('H. Gusra Yetri, SH');
            $table->string('jabatan_penandatangan')->default('Ketua DPD APPSI Banyuasin');
            $table->string('nama_sekretaris')->nullable();
            $table->string('jabatan_sekretaris')->default('Sekretaris DPD APPSI Banyuasin');
            $table->longText('isi_surat')->nullable();
            $table->string('hash_keabsahan')->nullable();
            $table->enum('status', ['draf', 'terkirim', 'selesai'])->default('terkirim');
            $table->timestamps();
        });

        // 7. Incoming Letters Table (Surat Masuk)
        Schema::create('incoming_letters', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat');
            $table->date('tanggal_surat');
            $table->date('tanggal_terima');
            $table->string('pengirim');
            $table->string('perihal');
            $table->text('keterangan')->nullable();
            $table->string('disposisi')->nullable();
            $table->enum('status', ['baru', 'diproses', 'selesai'])->default('baru');
            $table->string('file_lampiran')->nullable();
            $table->timestamps();
        });

        // 8. Meetings Table (Agenda & Notulen Rapat Pengurus Pasar)
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->string('judul_rapat');
            $table->date('tanggal');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai')->nullable();
            $table->string('tempat');
            $table->string('pimpinan_rapat');
            $table->string('notulis');
            $table->text('agenda');
            $table->longText('pembahasan')->nullable();
            $table->longText('keputusan')->nullable();
            $table->integer('jumlah_hadir')->default(0);
            $table->text('daftar_hadir')->nullable();
            $table->enum('status', ['terjadwal', 'berlangsung', 'selesai'])->default('selesai');
            $table->timestamps();
        });

        // 9. Inboxes Table (Buku Tamu & Aspirasi Pedagang / Kemitraan)
        Schema::create('inboxes', function (Blueprint $table) {
            $table->id();
            $table->dateTime('tanggal');
            $table->string('nama');
            $table->string('instansi')->nullable();
            $table->string('email')->nullable();
            $table->string('telepon')->nullable();
            $table->string('tujuan')->default('DPD APPSI Kabupaten Banyuasin');
            $table->string('keperluan');
            $table->text('pesan');
            $table->enum('status', ['baru', 'dibaca', 'dibalas'])->default('baru');
            $table->text('balasan')->nullable();
            $table->timestamps();
        });

        // 10. Settings Table
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
        Schema::dropIfExists('inboxes');
        Schema::dropIfExists('meetings');
        Schema::dropIfExists('incoming_letters');
        Schema::dropIfExists('letters');
        Schema::dropIfExists('galleries');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('organization_structures');
        Schema::dropIfExists('member_registrations');
        Schema::dropIfExists('members');
    }
};
