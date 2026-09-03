# APPSI Kabupaten Banyuasin (`appsiba.or.id`)

Portal Resmi & Sistem Informasi Manajemen Keanggotaan dan Persuratan **Dewan Pimpinan Daerah (DPD) Asosiasi Pedagang Pasar Seluruh Indonesia (APPSI) Kabupaten Banyuasin, Provinsi Sumatera Selatan**.

Website ini mengadopsi struktur informasi, hierarki desain, dan skema warna emerald green (`#007042` / `#047857`) dari DPP APPSI ([appsi.id](https://appsi.id/)).

---

## 🏛️ Profil Lembaga

- **Nama Lembaga**: Dewan Pimpinan Daerah Asosiasi Pedagang Pasar Seluruh Indonesia (DPD APPSI) Kabupaten Banyuasin
- **Ketua DPD**: H. Gusra Yetri, SH
- **Sekretaris DPD**: M. Rian Pratama, S.E.
- **Bendahara DPD**: Hj. Siti Aminah
- **Alamat Sekretariat**: Jalan Merdeka, Depan Pasar Baru Kelurahan Pangkalan Balai - Kecamatan Banyuasin III, Kabupaten Banyuasin, Sumatera Selatan
- **Kontak Resmi**: 0811 618 808 | appsi.banyuasin@gmail.com
- **Website Resmi**: [appsiba.or.id](https://appsiba.or.id) (Lokal Herd: `http://appsiba.test`)

---

## 🚀 Fitur Unggulan

### 1. Portal Publik (Adopsi `appsi.id`)
- **Beranda Interaktif**: Hero banner *"Gabung APPSI, Kuatkan Suara Pedagang Pasar!"*, 3 pilar APPSI (Advokasi & Perlindungan Hukum, Digitalisasi & Modernisasi Pasar, Akses Permodalan UMKM), sambutan Ketua DPD, warta kegiatan terkini, dan agenda pasar.
- **Struktur Organisasi**: Bagan kepengurusan hierarkis DPD APPSI Kabupaten Banyuasin periode 2024–2029.
- **Keanggotaan Pedagang**: Direktori pedagang pasar tradisional dengan filter multi-komoditas (Sembako, Sayur/Buah, Daging/Ikan, Konveksi, Kuliner, dll.) dan filter pasar daerah (Pangkalan Balai, Betung, Mariana, Sungsang, Sukajadi).
- **Pendaftaran Online Mandiri**: Formulir pendaftaran pedagang baru ramah smartphone dengan upload foto KTP dan kios.
- **Berita & Publikasi**: Warta berita pasar, pergerakan harga komoditas, dan kebijakan pasar tradisional.
- **Galeri Dokumentasi**: Dokumentasi foto kegiatan penataan dan revitalisasi pasar.
- **Verifikasi QR Keabsahan Surat**: Validasi keabsahan dokumen surat resmi digital APPSI melalui pemindaian QR Code.
- **Buku Tamu / Aspirasi Pedagang**: Saluran aspirasi pedagang pasar online langsung ke pengurus DPD.

### 2. Dashboard MIS Administrator
- **Executive Dashboard**: Ringkasan total pedagang, pendaftar baru yang menunggu verifikasi, surat keluar ber-QR, arsip surat masuk, dan notulen rapat pasar.
- **Manajemen Pedagang Pasar**: CRUD data pedagang, status keaktifan, komoditas, nomor kios/los, dan cetak Kartu Tanda Anggota (KTA) digital ber-QR.
- **Verifikasi Pendaftar Online**: Peninjauan berkas pendaftar baru dengan fitur 1-click Approval (otomatis generate NPA: `DPD-BA-01.XXXX`) atau Rejection.
- **Surat Keluar Resmi APPSI**: Penerbitan surat dinas ber-KOP resmi APPSI Banyuasin dengan penomoran otomatis `[No]/DPD-APPSI/BA/[Bulan Romawi]/[Tahun]`, tanda tangan resmi Ketua & Sekretaris, dan QR Code keabsahan unik.
- **Buku Arsip Surat Masuk**: Pengarsipan surat masuk dari dinas/instansi dan status disposisi.
- **Notulen Rapat & Musyawarah**: Pencatatan hasil rapat kerja, musyawarah pedagang, dan daftar kehadiran.
- **Buku Tamu & Aspirasi**: Pengelolaan pesan dan aduan fasilitas pasar yang masuk dari masyarakat pedagang.
- **Struktur Kepengurusan**: Pengaturan pejabat pengurus harian dan koordinator komisariat pasar daerah.
- **Profil Organisasi & KOP**: Pengaturan identitas DPD, penandatangan surat/KTA, visi, misi, dan ganti password administrator.

---

## 🔑 Akses Administrator Default

- **URL Login**: `http://appsiba.test/login` (atau `/admin`)
- **Email**: `admin@appsiba.or.id`
- **Password**: `admin123`

---

## 🛠️ Instalasi & Menjalankan Aplikasi

1. Clone repositori:
   ```bash
   git clone https://github.com/septaryanhidayat/appsiba.git
   cd appsiba
   ```

2. Instal dependensi PHP:
   ```bash
   composer install
   ```

3. Setup environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Jalankan migrasi & seeder data resmi APPSI Banyuasin:
   ```bash
   php artisan migrate:fresh --seed
   ```

5. Hubungkan storage symlink:
   ```bash
   php artisan storage:link
   ```

6. Buka di browser melalui Laravel Herd: `http://appsiba.test` atau jalankan dev server:
   ```bash
   php artisan serve
   ```

---

## 📄 Lisensi

Hak Cipta © 2026 DPD APPSI Kabupaten Banyuasin. Dilindungi undang-undang.
