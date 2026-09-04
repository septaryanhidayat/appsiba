# Cetak Biru Standar Formulir Pendaftaran Anggota APPSI Pusat
Dokumen Referensi Sistem: `https://keanggotaan.appsi.id`  
Target Implementasi: DPD APPSI Kabupaten Banyuasin (`appsiba.or.id`)  
Status: **Dokumen Spesifikasi & Rencana Pengembangan Masa Depan (Future Roadmap)**

---

## 1. Pendahuluan & Latar Belakang
Formulir pendaftaran anggota standar DPP APPSI Pusat dirancang komprehensif tidak hanya sekadar mencatat data diri pedagang, melainkan juga berfungsi sebagai:
1. **Basis Data Ekonomi Kerakyatan**: Memetakan profil omset, laba, dan kapasitas usaha pedagang pasar tradisional.
2. **Kelayakan Penyaluran KUR / Permodalan Perbankan**: Menjadi dasar rekomendasi permodalan resmi dari DPD APPSI ke bank mitra penyalur (seperti Bank Sumsel Babel, BRI, BNI, Mandiri).
3. **Standarisasi Komoditas Nasional**: Mengelompokkan jenis usaha pedagang ke dalam 22 klasifikasi komoditas resmi APPSI.
4. **Validasi Legalitas Lapak**: Memverifikasi SIPTU (Surat Izin Pemakaian Tempat Usaha) dan status sewa/hak milik lapak di pasar.

---

## 2. Alur Formulir Multi-Step (5 Tahapan)

Formulir menggunakan antarmuka bertahap (*wizard*) dengan navigasi samping (*sidebar tabs*):
- Tab 1: Identitas Anggota
- Tab 2: Data Tempat Usaha
- Tab 3: Data Modal / Asset
- Tab 4: Kebutuhan Modal Usaha
- Tab 5: Lampiran Berkas
- Sub-Fitur Eksternal: Cek Status Pendaftaran

---

### TAHAP 1: IDENTITAS ANGGOTA (DATA PRIBADI & DOMISILI)

| Nama Field (Database) | Tipe Input | Label UI | Wajib (Required) | Pilihan / Opsi / Validasi |
|---|---|---|:---:|---|
| `nama_lengkap` | Text | Nama Lengkap | Ya | Sesuai KTP |
| `jenis_identitas` | Select | Jenis Identitas | Ya | `KTP`, `SIM`, `PASSPORT` |
| `no_identitas` | Text | No Identitas | Ya | 16 Digit angka untuk NIK KTP |
| `tempat_lahir` | Text | Tempat Lahir | Ya | Nama kota/kabupaten |
| `tanggal_lahir` | Datepicker | Tanggal Lahir | Ya | Format: YYYY-MM-DD |
| `jenis_kelamin` | Radio | Jenis Kelamin | Ya | `Laki-Laki`, `Perempuan` |
| `status_pernikahan` | Select | Status Pernikahan | Ya | `Nikah`, `Belum Nikah`, `Duda/Janda` |
| `pendidikan_id` | Select | Pendidikan Terakhir | Tidak | `SD`, `SMP`, `SMA`, `Akademi/Sarjana` |
| `alamat_tempat_tinggal` | Textarea | Alamat Tempat Tinggal | Ya | Alamat domisili lengkap |
| `rt` | Text (Numbers) | RT | Tidak | Maksimal 5 digit |
| `rw` | Text (Numbers) | RW | Tidak | Maksimal 5 digit |
| `no_rumah` | Text | No. Rumah | Tidak | Nomor rumah |
| `provinsi_kode` | Select | Provinsi | Ya | Master Data Wilayah (Kemendagri) |
| `kabupaten_kota_kode` | Select | Kabupaten/Kota | Ya | Cascade berdasar Provinsi |
| `kecamatan_kode` | Select | Kecamatan | Ya | Cascade berdasar Kab/Kota |
| `kelurahan_kode` | Select | Kelurahan | Ya | Cascade berdasar Kecamatan |
| `kodepos` | Text (Numbers) | Kode Pos | Tidak | 5 digit angka |
| `telepon_rumah` | Text (Numbers) | No. Telepon Rumah | Tidak | Nomor telepon PSTN/kabel |
| `telepon_tempat_usaha`| Text (Numbers) | No. Telp Tempat Usaha| Tidak | Nomor telepon ruko/kios |
| `no_hp` | Text (Numbers) | No. HP / WhatsApp | Ya | Format: 08xxxxxxxxxx |
| `email` | Email | Alamat Email | Tidak | Format email valid |

---

### TAHAP 2: DATA TEMPAT USAHA & 22 KOMODITAS RESMI

| Nama Field (Database) | Tipe Input | Label UI | Wajib | Pilihan / Opsi / Validasi |
|---|---|---|:---:|---|
| `jenis_tempat_usaha_id`| Select | Jenis Tempat Usaha | Ya | `Ruko/Toko`, `Kios`, `Los`, `Lapak/Counter`, `PKL` |
| `alamat_tempat_usaha` | Textarea | Alamat Tempat Usaha | Ya | Lokasi lapak di pasar |
| `blok_tempat_usaha` | Text | Blok / No. Kios | Tidak | Contoh: Blok B No. 14 |
| `luas_tempat_usaha` | Number | Luas Lapak (m²) | Tidak | Satuan meter persegi |
| `golongan_usaha_id` | Select | Golongan Usaha | Ya | `Distributor`, `Agen`, `Grosir`, `Eceran` |
| `status_tempat_usaha` | Select | Status Tempat Usaha | Ya | `Milik Sendiri`, `Sewa`, `Kerjasama`, `Lain-Lain` |
| `provinsi_kode_pasar` | Select | Provinsi Pasar | Ya | Default: Sumatera Selatan (16) |
| `kabupaten_pasar` | Select | Kab/Kota Pasar | Ya | Default: Kabupaten Banyuasin |
| `pasar_id` | Select | Nama Pasar Tradisional | Ya | Daftar Pasar Binaan DPD APPSI |
| `pasar_lain` | Text | Nama Pasar Lainnya | Opsional| Muncul jika pilih 'Pasar Lainnya' |
| `pasar_address` | Text (Readonly)| Alamat Pasar | Otomatis | Terisi otomatis sesuai nama pasar |

#### Daftar 22 Komoditas Dagangan Standar APPSI (`arr_jenis_usaha_id[]` - Checkbox Multi-Select):
1. **Logam Mulia** (Emas, Perak, Perhiasan)
2. **Jam**
3. **Textil / Pakaian** (Baju, Celana, Kain)
4. **Sepatu / Tas**
5. **Aksesoris**
6. **ATK / Buku**
7. **Peralatan Rumah Tangga**
8. **Elektronik**
9. **Handphone**
10. **Sparepart Mobil**
11. **Sparepart Motor**
12. **Sparepart Elektronik**
13. **Sembako** (Beras, Minyak, Gula, Tepung)
14. **Kelontong**
15. **Buah-Buahan**
16. **Sayur Mayur**
17. **Bumbu Dapur**
18. **Daging Sapi**
19. **Daging Kambing**
20. **Ayam**
21. **Ikan** (Ikan Laut, Ikan Tawar, Udang, Hasil Laut)
22. **Makanan / Minuman** (Kuliner Pasar, Siap Saji)

---

### TAHAP 3: DATA KEUANGAN / MODAL & ASSET (FORMAT RUPIAH)

Semua field pada tahap ini menggunakan format pemisah ribuan otomatis (contoh: Rp 15.000.000):

| Nama Field (Database) | Tipe Data | Label UI | Deskripsi |
|---|---|---|---|
| `modal_usaha` | Decimal(15,2) | Modal/Asset Usaha | Total estimasi nilai modal barang & aset dagang |
| `omset_harian` | Decimal(15,2) | Omset Harian | Rata-rata penerimaan bruto per hari |
| `laba_harian` | Decimal(15,2) | Laba Harian (Rata-rata) | Rata-rata keuntungan bersih per hari |
| `penghasilan_lain` | Decimal(15,2) | Penghasilan Lain | Pendapatan tambahan di luar usaha pasar |
| `hutang_bank` | Decimal(15,2) | Hutang Bank | Saldo pinjaman perbankan berjalan (jika ada) |
| `hutang_koperasi` | Decimal(15,2) | Hutang Koperasi | Saldo pinjaman koperasi pasar (jika ada) |
| `hutang_supplier` | Decimal(15,2) | Hutang Supplier | Tanggungan pembayaran barang ke agen/distributor |
| `hutang_lain_lain` | Decimal(15,2) | Hutang Lain-lain | Beban hutang perseorangan / lainnya |
| `jumlah_angsuran` | Decimal(15,2) | Mempunyai Angsuran Sebesar | Nilai kewajiban cicilan periodik |
| `jenis_angsuran` | Enum / Select | Jenis Angsuran | Pilihan: `Harian`, `Mingguan`, `Bulanan` |

---

### TAHAP 4: KEBUTUHAN MODAL USAHA (PROGRAM KUR & BANTUAN MODAL)

Bagian ini menjadi instrumen utama untuk pengelompokan program kemitraan permodalan:
1. **Status Kebutuhan Modal**:
   - Pilihan Radio:
     - `Cukup` (Tidak memerlukan bantuan kredit/modal tambahan saat ini)
     - `Butuh Bantuan` (Memerlukan fasilitasi modal kerja / KUR)

2. **Rentang Nominal Tambahan Modal yang Dibutuhkan (`tambahan_modal_usaha_id`)**:
   - Tier 1: `Rp 0 - Rp 1.000.000` (Mikro ULaMM / Ultra Mikro)
   - Tier 2: `Rp 1.000.000 - Rp 5.000.000` (KUR Super Mikro)
   - Tier 3: `Rp 5.000.000 - Rp 20.000.000` (KUR Mikro)
   - Tier 4: `Rp 20.000.000 - Rp 50.000.000` (KUR Ritel Kecil)
   - Tier 5: `Rp 50.000.000 - Rp 100.000.000` (KUR Menengah)
   - Tier 6: `Rp 100.000.000 - Rp 200.000.000` (Kredit Usaha Komersial/Grosir)

---

### TAHAP 5: LAMPIRAN DOKUMEN & KEAMANAN

Setiap berkas diunggah dengan batasan ukuran (maksimal 2MB - 5MB per berkas) dan dilengkapi tampilan pratinjau (*live preview*):

| Nama Field | Tipe Berkas | Label UI | Status |
|---|---|---|:---:|
| `foto` | File (JPG/PNG/WebP) | Pas Foto Diri Pedagang | Sangat Dianjurkan (Untuk Kartu KTA) |
| `foto_identitas` | File (JPG/PNG/PDF) | Foto KTP / SIM / Paspor | Wajib untuk verifikasi identitas |
| `foto_kk` | File (JPG/PNG/PDF) | Foto Kartu Keluarga (KK) | Pendukung kelayakan permodalan |
| `foto_cv` | File (PDF/DOCX) | Profil Singkat / CV Usaha | Opsional |
| `foto_siptu` | File (JPG/PNG/PDF) | SIPTU / Surat Keterangan Usaha | Pendukung hak penempatan lapak |
| `captcha` | String | Kode Keamanan (Captcha) | Wajib (Anti-spam / robot) |

---

## 3. Fitur Tambahan: Cek Status Pendaftaran Mandiri
Halaman khusus: `/keanggotaan/cek-pendaftaran`
- **Input**: Nomor Identitas (NIK) atau Nomor Registrasi Online.
- **Output Status**:
  - `Menunggu Verifikasi Pengurus DPD`: Berkas sedang diteliti oleh tim sekretariat.
  - `Disetujui`: Nomor KTA resmi telah terbit, kartu KTA digital siap diunduh/dicetak.
  - `Perlu Perbaikan / Ditolak`: Disertai catatan pengurus (misal: "Foto KTP buram, harap perbarui").

---

## 4. Rencana Langkah Migrasi Database (Untuk Eksekusi Mendatang)

Ketika DPD APPSI Banyuasin siap mengimplementasikan standar ini secara penuh, langkah teknis yang akan dilakukan:

1. **Migration Laravel**:
   Menambahkan kolom-kolom finansial dan tempat usaha ke tabel `member_registrations` dan `members`:
   ```php
   Schema::table('member_registrations', function (Blueprint $table) {
       $table->string('jenis_identitas')->default('KTP')->after('nik');
       $table->string('tempat_lahir')->nullable()->after('jenis_identitas');
       $table->date('tanggal_lahir')->nullable()->after('tempat_lahir');
       $table->enum('jenis_kelamin', ['Laki-Laki', 'Perempuan'])->nullable()->after('tanggal_lahir');
       $table->enum('status_pernikahan', ['Nikah', 'Belum Nikah', 'Duda/Janda'])->nullable();
       $table->string('pendidikan')->nullable();
       $table->string('rt', 10)->nullable();
       $table->string('rw', 10)->nullable();
       $table->string('no_rumah', 20)->nullable();
       $table->string('kodepos', 10)->nullable();
       $table->string('telepon_usaha')->nullable();
       
       // Usaha & Lapak
       $table->string('blok_nomor')->nullable();
       $table->decimal('luas_lapak', 8, 2)->nullable();
       $table->json('komoditas_ids')->nullable(); // Menyimpan multi-select 22 komoditas
       $table->string('golongan_usaha')->nullable(); // Distributor, Agen, Grosir, Eceran
       $table->string('status_tempat_usaha')->nullable(); // Milik Sendiri, Sewa, dll.
       
       // Finansial
       $table->decimal('modal_usaha', 15, 2)->nullable();
       $table->decimal('omset_harian', 15, 2)->nullable();
       $table->decimal('laba_harian', 15, 2)->nullable();
       $table->decimal('penghasilan_lain', 15, 2)->nullable();
       $table->decimal('hutang_bank', 15, 2)->nullable();
       $table->decimal('hutang_koperasi', 15, 2)->nullable();
       $table->decimal('hutang_supplier', 15, 2)->nullable();
       $table->decimal('hutang_lain_lain', 15, 2)->nullable();
       $table->decimal('jumlah_angsuran', 15, 2)->nullable();
       $table->string('jenis_angsuran')->nullable(); // Harian, Mingguan, Bulanan
       
       // Bantuan Modal
       $table->enum('kebutuhan_modal', ['Cukup', 'Butuh Bantuan'])->default('Cukup');
       $table->string('rentang_bantuan_modal')->nullable();
       
       // Lampiran Tambahan
       $table->string('foto_kk')->nullable();
       $table->string('foto_cv')->nullable();
       $table->string('foto_siptu')->nullable();
   });
   ```

2. **Frontend UI Upgrade**:
   Membuat view komponen `resources/views/public/keanggotaan/daftar-wizard.blade.php` dengan Alpine.js untuk transisi antar langkah (*multi-step wizard*) yang interaktif, elegan, dan ramah pengguna di smartphone.

---
*Dokumen ini disimpan permanen di dalam repositori kode sebagai acuan spesifikasi resmi bagi tim pengembang DPD APPSI Kabupaten Banyuasin.*
