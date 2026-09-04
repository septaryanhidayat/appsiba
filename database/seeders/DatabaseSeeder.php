<?php

namespace Database\Seeders;

use App\Models\Gallery;
use App\Models\Inbox;
use App\Models\Letter;
use App\Models\Meeting;
use App\Models\Member;
use App\Models\OrganizationStructure;
use App\Models\Post;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Admin User
        User::updateOrCreate(
            ['email' => 'admin@appsiba.or.id'],
            [
                'name' => 'Administrator APPSI Banyuasin',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
            ]
        );

        // 2. Settings (APPSI Banyuasin & appsi.id reference)
        $settings = [
            'nama_organisasi' => 'Dewan Pimpinan Daerah (DPD) Asosiasi Pedagang Pasar Seluruh Indonesia (APPSI) Kabupaten Banyuasin',
            'singkatan' => 'DPD APPSI KABUPATEN BANYUASIN',
            'nama_ketua' => 'H. Gusra Yetri, SH',
            'jabatan_ketua' => 'Ketua DPD APPSI Kabupaten Banyuasin',
            'nama_sekretaris' => 'M. Rian Pratama, S.E.',
            'jabatan_sekretaris' => 'Sekretaris DPD APPSI Kabupaten Banyuasin',
            'nama_bendahara' => 'Hj. Siti Aminah',
            'alamat' => 'Jalan Merdeka, Depan Pasar Baru Kelurahan Pangkalan Balai - Kecamatan Banyuasin III, Kabupaten Banyuasin, Sumatera Selatan',
            'telepon' => '0811 618 808',
            'whatsapp' => '62811618808',
            'email' => 'appsi.banyuasin@gmail.com',
            'website' => 'https://appsiba.or.id',
            'periode' => '2024 - 2029',
            'visi' => 'Mewujudkan Pasar Tradisional yang Kuat, Mandiri, dan Berdaya Saing untuk Kesejahteraan Pedagang dan Masyarakat Indonesia.',
            'misi' => "1. Komunitas Daerah: Terhubung dengan pedagang pasar di seluruh Kabupaten Banyuasin dan jejaring nasional.\n2. Advokasi & Perlindungan: Memperjuangkan hak dan kepentingan pedagang pasar tradisional.\n3. Penguatan Kapasitas: Program, pelatihan digitalisasi, dan informasi untuk kemajuan usaha bersama.\n4. Kemitraan: Sinergi dengan instansi pemerintah, BUMD, dan perbankan demi permodalan dan fasilitas pasar yang higienis.",
            'sambutan_ketua' => 'Bergabung dan jadilah bagian dari Asosiasi Pedagang Pasar Seluruh Indonesia sekarang! Bersama membangun pasar tradisional yang kuat, mandiri, dan berdaya saing untuk kesejahteraan pedagang dan masyarakat Banyuasin.',
            'tentang_organisasi' => 'Asosiasi Pedagang Pasar Seluruh Indonesia (APPSI) adalah wadah resmi yang menghimpun, mewakili, dan memperjuangkan kepentingan pedagang pasar tradisional di seluruh Indonesia. Kami berkomitmen untuk membangun pasar tradisional yang kuat, mandiri, dan berdaya saing melalui kolaborasi, advokasi, dan pengembangan kapasitas para pedagang.',
        ];

        foreach ($settings as $key => $value) {
            Setting::set($key, $value);
        }

        // 3. Organization Structures
        OrganizationStructure::query()->delete();
        $orgData = [
            [
                'nama' => 'H. Gusra Yetri, SH',
                'jabatan' => 'Ketua DPD',
                'divisi' => 'Pimpinan Harian',
                'urutan' => 1,
                'foto' => 'assets/images/ketua-appsi-banyuasin.webp',
                'no_hp' => '0811 618 808',
                'email' => 'gusra.yetri@appsiba.or.id',
            ],
            [
                'nama' => 'H. Ahmad Basir, S.E.',
                'jabatan' => 'Wakil Ketua I (Organisasi & Keanggotaan)',
                'divisi' => 'Pimpinan Harian',
                'urutan' => 2,
                'foto' => 'assets/images/default-avatar-gray.png',
                'no_hp' => '0813-7301-4422',
                'email' => 'ahmad.basir@appsiba.or.id',
            ],
            [
                'nama' => 'Drs. Zulkarnain',
                'jabatan' => 'Wakil Ketua II (Advokasi & Hukum Pedagang)',
                'divisi' => 'Pimpinan Harian',
                'urutan' => 3,
                'foto' => 'assets/images/default-avatar-gray.png',
                'no_hp' => '0821-8890-1122',
                'email' => 'zulkarnain@appsiba.or.id',
            ],
            [
                'nama' => 'Ir. H. Syamsudin',
                'jabatan' => 'Wakil Ketua III (Kemitraan, Perbankan & UMKM)',
                'divisi' => 'Pimpinan Harian',
                'urutan' => 4,
                'foto' => 'assets/images/default-avatar-gray.png',
                'no_hp' => '0812-7100-3344',
                'email' => 'syamsudin@appsiba.or.id',
            ],
            [
                'nama' => 'M. Rian Pratama, S.E.',
                'jabatan' => 'Sekretaris Umum',
                'divisi' => 'Sekretariat',
                'urutan' => 5,
                'foto' => 'assets/images/default-avatar-gray.png',
                'no_hp' => '0852-6711-2233',
                'email' => 'sekretaris@appsiba.or.id',
            ],
            [
                'nama' => 'Hendra Gunawan',
                'jabatan' => 'Wakil Sekretaris',
                'divisi' => 'Sekretariat',
                'urutan' => 6,
                'foto' => 'assets/images/default-avatar-gray.png',
                'no_hp' => '0822-8119-0099',
                'email' => 'hendra@appsiba.or.id',
            ],
            [
                'nama' => 'Hj. Siti Aminah',
                'jabatan' => 'Bendahara Umum',
                'divisi' => 'Kebendaharaan',
                'urutan' => 7,
                'foto' => 'assets/images/default-avatar-gray.png',
                'no_hp' => '0813-6800-4411',
                'email' => 'bendahara@appsiba.or.id',
            ],
            [
                'nama' => 'Nurhayati, S.Sos.',
                'jabatan' => 'Wakil Bendahara',
                'divisi' => 'Kebendaharaan',
                'urutan' => 8,
                'foto' => 'assets/images/default-avatar-gray.png',
                'no_hp' => '0813-7766-5544',
                'email' => 'nurhayati@appsiba.or.id',
            ],
            [
                'nama' => 'H. Burhanudin',
                'jabatan' => 'Koordinator Bidang Sarana & Penataan Pasar',
                'divisi' => 'Bidang Sarana Pasar',
                'urutan' => 9,
                'foto' => 'assets/images/default-avatar-gray.png',
                'no_hp' => '0853-8822-1133',
                'email' => 'burhanudin@appsiba.or.id',
            ],
            [
                'nama' => 'Siti Fatimah',
                'jabatan' => 'Koordinator Pemberdayaan Pedagang Wanita',
                'divisi' => 'Bidang Pemberdayaan Perempuan',
                'urutan' => 10,
                'foto' => 'assets/images/default-avatar-gray.png',
                'no_hp' => '0821-9988-7711',
                'email' => 'siti.fatimah@appsiba.or.id',
            ],
            [
                'nama' => 'Robi Chandra',
                'jabatan' => 'Ketua Komisariat Pasar Pangkalan Balai',
                'divisi' => 'Komisariat Pasar',
                'urutan' => 11,
                'foto' => 'assets/images/default-avatar-gray.png',
                'no_hp' => '0812-7722-3344',
                'email' => 'pasar.pangkalanbalai@appsiba.or.id',
            ],
            [
                'nama' => 'Usman Effendi',
                'jabatan' => 'Ketua Komisariat Pasar Betung',
                'divisi' => 'Komisariat Pasar',
                'urutan' => 12,
                'foto' => 'assets/images/default-avatar-gray.png',
                'no_hp' => '0813-8833-2211',
                'email' => 'pasar.betung@appsiba.or.id',
            ],
            [
                'nama' => 'Marzuki',
                'jabatan' => 'Ketua Komisariat Pasar Mariana',
                'divisi' => 'Komisariat Pasar',
                'urutan' => 13,
                'foto' => 'assets/images/default-avatar-gray.png',
                'no_hp' => '0852-7711-9900',
                'email' => 'pasar.mariana@appsiba.or.id',
            ],
        ];

        foreach ($orgData as $org) {
            OrganizationStructure::create($org);
        }

        // 4. Members (Pedagang Pasar dengan Foto Default Avatar Gray)
        Member::query()->delete();
        $traders = [
            [
                'nama' => 'H. Gusra Yetri, SH',
                'nik' => '1607011205730001',
                'nomor_anggota' => 'DPD-BA-01.0001',
                'nama_usaha' => 'Toko Sembako Berkah Maju',
                'jenis_usaha' => 'Sembako & Kebutuhan Pokok',
                'bentuk_usaha' => 'Kios',
                'lokasi_pasar' => 'Pasar Pangkalan Balai',
                'blok_nomor' => 'Blok A No. 01-02',
                'no_hp' => '0811 618 808',
                'email' => 'gusra.yetri@appsiba.or.id',
                'alamat_domisili' => 'Kel. Pangkalan Balai, Banyuasin III',
                'foto' => 'assets/images/default-avatar-gray.png',
                'foto_usaha' => null,
                'terdaftar_sejak' => '2020-01-15',
                'status' => 'aktif',
                'catatan' => 'Ketua DPD APPSI Kabupaten Banyuasin',
            ],
            [
                'nama' => 'Hj. Rohana',
                'nik' => '1607014508750002',
                'nomor_anggota' => 'DPD-BA-01.0002',
                'nama_usaha' => 'Kios Sayur Segar Bumi Lestari',
                'jenis_usaha' => 'Sayur, Buah & Hasil Bumi',
                'bentuk_usaha' => 'Los',
                'lokasi_pasar' => 'Pasar Pangkalan Balai',
                'blok_nomor' => 'Los Sayur No. 08',
                'no_hp' => '0813-7722-1144',
                'email' => 'rohana.sayur@gmail.com',
                'alamat_domisili' => 'Desa Tanjung Kepayang, Banyuasin III',
                'foto' => 'assets/images/default-avatar-gray.png',
                'foto_usaha' => null,
                'terdaftar_sejak' => '2021-03-10',
                'status' => 'aktif',
                'catatan' => 'Pemasok sayur mayur lokal dataran Banyuasin',
            ],
            [
                'nama' => 'Slamet Riyadi',
                'nik' => '1607021504800003',
                'nomor_anggota' => 'DPD-BA-01.0003',
                'nama_usaha' => 'Daging Sapi & Kambing Barokah Jaya',
                'jenis_usaha' => 'Daging, Unggas & Ikan Segar',
                'bentuk_usaha' => 'Kios',
                'lokasi_pasar' => 'Pasar Betung',
                'blok_nomor' => 'Blok Daging No. 04',
                'no_hp' => '0821-8877-3322',
                'email' => 'slamet.daging@gmail.com',
                'alamat_domisili' => 'Kel. Rimba Asam, Betung',
                'foto' => 'assets/images/default-avatar-gray.png',
                'foto_usaha' => null,
                'terdaftar_sejak' => '2021-06-20',
                'status' => 'aktif',
                'catatan' => 'Sertifikasi Halal RPH terverifikasi',
            ],
            [
                'nama' => 'M. Yusuf Ridho',
                'nik' => '1607011003880004',
                'nomor_anggota' => 'DPD-BA-01.0004',
                'nama_usaha' => 'Busana Muslimah Siti Khadijah',
                'jenis_usaha' => 'Pakaian, Konveksi & Tekstil',
                'bentuk_usaha' => 'Kios',
                'lokasi_pasar' => 'Pasar Pangkalan Balai',
                'blok_nomor' => 'Blok B No. 14',
                'no_hp' => '0852-6789-0011',
                'email' => 'yusuf.busana@gmail.com',
                'alamat_domisili' => 'Kel. Mulia Agung, Banyuasin III',
                'foto' => 'assets/images/default-avatar-gray.png',
                'foto_usaha' => null,
                'terdaftar_sejak' => '2022-01-10',
                'status' => 'aktif',
                'catatan' => 'Menjual aneka busana muslim, gamis, dan batik Banyuasin',
            ],
            [
                'nama' => 'Ibu Mardiana',
                'nik' => '1607036012780005',
                'nomor_anggota' => 'DPD-BA-01.0005',
                'nama_usaha' => 'Warung Pindang Pegagan & Kuliner Pasar',
                'jenis_usaha' => 'Kuliner & Jajanan Tradisional',
                'bentuk_usaha' => 'Kios',
                'lokasi_pasar' => 'Pasar Mariana',
                'blok_nomor' => 'Kios Kuliner No. 02',
                'no_hp' => '0812-7311-5566',
                'email' => 'mardiana.kuliner@gmail.com',
                'alamat_domisili' => 'Kel. Mariana, Banyuasin I',
                'foto' => 'assets/images/default-avatar-gray.png',
                'foto_usaha' => null,
                'terdaftar_sejak' => '2022-04-18',
                'status' => 'aktif',
                'catatan' => 'Pusat jajanan dan lauk pauk tradisional pasar',
            ],
            [
                'nama' => 'H. Thamrin',
                'nik' => '1607022209700006',
                'nomor_anggota' => 'DPD-BA-01.0006',
                'nama_usaha' => 'Grosir Beras & Gula Saudara',
                'jenis_usaha' => 'Sembako & Kebutuhan Pokok',
                'bentuk_usaha' => 'Ruko Pasar',
                'lokasi_pasar' => 'Pasar Betung',
                'blok_nomor' => 'Ruko Pasar No. 05-06',
                'no_hp' => '0813-7890-4455',
                'email' => 'thamrin.grosir@gmail.com',
                'alamat_domisili' => 'Kecamatan Betung, Banyuasin',
                'foto' => 'assets/images/default-avatar-gray.png',
                'foto_usaha' => null,
                'terdaftar_sejak' => '2020-08-01',
                'status' => 'aktif',
                'catatan' => 'Distributor beras lokal dataran Banyuasin',
            ],
            [
                'nama' => 'Edi Santoso',
                'nik' => '1607011906840007',
                'nomor_anggota' => 'DPD-BA-01.0007',
                'nama_usaha' => 'Kelontong & Alat Rumah Tangga Mandiri',
                'jenis_usaha' => 'Kelontong & Aneka Plastik',
                'bentuk_usaha' => 'Kios',
                'lokasi_pasar' => 'Pasar Pangkalan Balai',
                'blok_nomor' => 'Blok C No. 09',
                'no_hp' => '0822-7901-2345',
                'email' => 'edi.kelontong@gmail.com',
                'alamat_domisili' => 'Kel. Kedondong Raye, Banyuasin III',
                'foto' => 'assets/images/default-avatar-gray.png',
                'foto_usaha' => null,
                'terdaftar_sejak' => '2022-08-14',
                'status' => 'aktif',
                'catatan' => 'Menyediakan perkakas plastik, pecah belah, dan kebutuhan harian',
            ],
            [
                'nama' => 'Andi Wijaya',
                'nik' => '1607051411900008',
                'nomor_anggota' => 'DPD-BA-01.0008',
                'nama_usaha' => 'Servis Elektronik & Jam Cahaya Terang',
                'jenis_usaha' => 'Elektronik, Servis & Aneka Jasa',
                'bentuk_usaha' => 'Kios',
                'lokasi_pasar' => 'Pasar Sukajadi (Talang Kelapa)',
                'blok_nomor' => 'Blok Jasa No. 03',
                'no_hp' => '0852-7899-1212',
                'email' => 'andi.servis@gmail.com',
                'alamat_domisili' => 'Kel. Sukajadi, Talang Kelapa',
                'foto' => 'assets/images/default-avatar-gray.png',
                'foto_usaha' => null,
                'terdaftar_sejak' => '2023-02-11',
                'status' => 'aktif',
                'catatan' => 'Jasa perbaikan kelistrikan dan suku cadang alat rumah tangga',
            ],
            [
                'nama' => 'Cik Maryam',
                'nik' => '1607045501820009',
                'nomor_anggota' => 'DPD-BA-01.0009',
                'nama_usaha' => 'Aneka Ikan Segar & Udang Sungai Sungsang',
                'jenis_usaha' => 'Daging, Unggas & Ikan Segar',
                'bentuk_usaha' => 'Los',
                'lokasi_pasar' => 'Pasar Sungsang',
                'blok_nomor' => 'Los Basah No. 11',
                'no_hp' => '0812-7188-4400',
                'email' => 'maryam.ikan@gmail.com',
                'alamat_domisili' => 'Desa Sungsang I, Banyuasin II',
                'foto' => 'assets/images/default-avatar-gray.png',
                'foto_usaha' => null,
                'terdaftar_sejak' => '2023-05-19',
                'status' => 'aktif',
                'catatan' => 'Hasil tangkapan nelayan pesisir muara Banyuasin',
            ],
            [
                'nama' => 'Herman Syafei',
                'nik' => '1607021102860010',
                'nomor_anggota' => 'DPD-BA-01.0010',
                'nama_usaha' => 'Kios Buah Segar Nusantara',
                'jenis_usaha' => 'Sayur, Buah & Hasil Bumi',
                'bentuk_usaha' => 'Los',
                'lokasi_pasar' => 'Pasar Betung',
                'blok_nomor' => 'Los Buah No. 07',
                'no_hp' => '0853-6677-8899',
                'email' => 'herman.buah@gmail.com',
                'alamat_domisili' => 'Desa Lubuk Karet, Betung',
                'foto' => 'assets/images/default-avatar-gray.png',
                'foto_usaha' => null,
                'terdaftar_sejak' => '2023-09-05',
                'status' => 'aktif',
                'catatan' => 'Aneka buah segar lokal dan pilihan',
            ],
        ];

        foreach ($traders as $trader) {
            Member::create($trader);
        }

        // 5. Posts (Berita & Kegiatan Resmi DPD APPSI Kabupaten Banyuasin)
        Post::query()->delete();
        $posts = [
            [
                'judul' => 'DPD APPSI Banyuasin Akselerasi Digitalisasi Pasar dan Pembayaran QRIS di Pasar Pangkalan Balai',
                'slug' => 'dpd-appsi-banyuasin-akselerasi-digitalisasi-pasar-dan-pembayaran-qris-di-pasar-pangkalan-balai',
                'kategori' => 'Digitalisasi Pasar',
                'penulis' => 'Humas DPD Banyuasin',
                'ringkasan' => 'DPD APPSI Banyuasin bersama Bank Sumsel Babel dan Dinas Perindagkop memfasilitasi ratusan pedagang pasar tradisional mengadopsi sistem transaksi digital non-tunai QRIS.',
                'konten' => '<p>Pangkalan Balai — Dewan Pimpinan Daerah Asosiasi Pedagang Pasar Seluruh Indonesia (DPD APPSI) Kabupaten Banyuasin secara resmi meluncurkan inisiatif percepatan transformasi digital bagi para pedagang di Pasar Pangkalan Balai.</p><p>Ketua DPD APPSI Kabupaten Banyuasin, <strong>H. Gusra Yetri, SH</strong>, didampingi perwakilan perbankan daerah dan Dinas Perdagangan, Koperasi, dan UKM Kabupaten Banyuasin, turun langsung ke blok sembako dan pakaian untuk mendampingi aktivasi kode QRIS pedagang.</p><p>"Pasar tradisional tidak boleh tertinggal oleh pesatnya era ekonomi digital. Dengan QRIS, pedagang pasar kita tidak perlu repot mencari uang kembalian, transaksi tercatat otomatis, serta terhindar dari risiko uang palsu," ujar H. Gusra Yetri di sela-sela peninjauan kios.</p><p>Program ini ditargetkan menjangkau lebih dari 450 pedagang di 3 pasar percontohan dalam kurun waktu semester pertama kepengurusan.</p>',
                'gambar' => 'assets/images/berita/berita-qris-digital.jpg',
                'status' => 'published',
                'views_count' => 428,
                'published_at' => now()->subDays(1),
            ],
            [
                'judul' => 'Gelar Operasi Pasar Pangan Murah di Betung, APPSI Banyuasin Kawal Stabilitas Harga Beras dan Minyak Goreng',
                'slug' => 'gelar-operasi-pasar-pangan-murah-di-betung-appsi-banyuasin-kawal-stabilitas-harga-beras-dan-minyak-goreng',
                'kategori' => 'Stabilisasi Pangan',
                'penulis' => 'M. Rian Pratama, S.E.',
                'ringkasan' => 'Upaya konkret menekan lonjakan inflasi bahan pokok di jalur lintas timur, APPSI Banyuasin bersinergi mendistribusikan ribuan liter minyak goreng dan beras medium berkualitas.',
                'konten' => '<p>Betung — Menanggapi fluktuasi harga kebutuhan pokok di wilayah perbatasan dan jalur lintas Sumatra, DPD APPSI Banyuasin menggelar aksi tanggap stabilitas pasokan pangan murah di kawasan Pasar Betung.</p><p>Aksi ini melibatkan kolaborasi langsung antara para pedagang grosir sembako lokal anggota APPSI dengan distributor resmi produsen pangan daerah. Penjualan paket beras SPHP dan minyak goreng bersubsidi berlangsung tertib dan disambut antusias oleh para pedagang eceran maupun pembeli rumah tangga.</p><p>Sekretaris DPD APPSI Banyuasin, <strong>M. Rian Pratama, S.E.</strong>, menegaskan komitmen APPSI dalam memotong rantai distribusi yang berbelit-belit agar harga jual di tingkat lapak pedagang tetap terjangkau dan menguntungkan kedua belah pihak.</p>',
                'gambar' => 'assets/images/berita/berita-operasi-pasar.jpg',
                'status' => 'published',
                'views_count' => 389,
                'published_at' => now()->subDays(2),
            ],
            [
                'judul' => 'Bebaskan Pedagang dari Rentenir, APPSI Banyuasin Buka Akses KUR Tanpa Agunan Tambahan di Sukajadi',
                'slug' => 'bebaskan-pedagang-dari-rentenir-appsi-banyuasin-buka-akses-kur-tanpa-agunan-tambahan-di-sukajadi',
                'kategori' => 'Permodalan KUR',
                'penulis' => 'Bidang Kemitraan UMKM',
                'ringkasan' => 'DPD APPSI memfasilitasi program pembiayaan Kredit Usaha Rakyat (KUR) berbunga rendah untuk modal kerja pedagang Pasar Sukajadi Talang Kelapa.',
                'konten' => '<p>Talang Kelapa — Praktik pinjaman berbunga tinggi atau rentenir harian sering kali menjadi jeratan berat bagi kelangsungan usaha pedagang pasar tradisional. Menyikapi persoalan ini, DPD APPSI Kabupaten Banyuasin menggelar sosialisasi dan pendampingan pengajuan KUR Perbankan di Pasar Sukajadi.</p><p>Melalui rekomendasi keanggotaan KTA APPSI, para pedagang mendapatkan asistensi pemberkasan izin usaha nomor induk berusaha (NIB) serta kelayakan pembukuan sederhana, sehingga proses pencairan modal kerja dapat berjalan cepat dan transparan.</p><p>"Misi utama APPSI adalah melindungi ekonomi pedagang kecil. Kami ingin modal kerja pedagang bertumbuh sehat lewat jalur perbankan formal yang dilindungi pemerintah," terang perwakilan Bidang Kemitraan DPD APPSI Banyuasin.</p>',
                'gambar' => 'assets/images/berita/berita-permodalan-kur.jpg',
                'status' => 'published',
                'views_count' => 312,
                'published_at' => now()->subDays(4),
            ],
            [
                'judul' => 'Advokasi Sanitasi & Revitalisasi Drainase Pasar Sungsang Demi Kenyamanan Pedagang dan Pembeli',
                'slug' => 'advokasi-sanitasi-revitalisasi-drainase-pasar-sungsang-demi-kenyamanan-pedagang-dan-pembeli',
                'kategori' => 'Advokasi Pasar',
                'penulis' => 'Bidang Sarana & Prasarana',
                'ringkasan' => 'APPSI mengawal aspirasi pedagang los basah ikan dan hasil laut Sungsang terkait perbaikan sistem saluran pembuangan air dan dermaga bongkar muat.',
                'konten' => '<p>Banyuasin II — Pasar Sungsang yang terkenal sebagai sentra perdagangan hasil laut dan ikan segar di pesisir muara Banyuasin memerlukan perhatian khusus pada sarana sanitasi dan drainase pembuangan air asin.</p><p>Tim advokasi DPD APPSI Banyuasin bersama pengurus Komisariat Pasar (PKP) Sungsang melakukan survei lapangan dan menyusun draf rekomendasi teknis perbaikan fasilitas saluran kepada instansi terkait.</p><p>Langkah ini penting agar kebersihan pasar tetap terjaga, aroma tidak mengganggu pemukiman sekitar, serta dermaga sandar kapal pembawa pasokan ikan nelayan dapat beroperasi dengan aman saat pasang surut air laut.</p>',
                'gambar' => 'assets/images/berita/berita-pasar-sungsang.jpg',
                'status' => 'published',
                'views_count' => 276,
                'published_at' => now()->subDays(5),
            ],
            [
                'judul' => 'Konsolidasi Komisariat Pasar (PKP) se-Banyuasin: Perkuat Soliditas & Payung Perlindungan Hukum',
                'slug' => 'konsolidasi-komisariat-pasar-pkp-se-banyuasin-perkuat-soliditas-payung-perlindungan-hukum',
                'kategori' => 'Organisasi',
                'penulis' => 'Humas DPD Banyuasin',
                'ringkasan' => 'Rapat konsolidasi pengurus komisariat pasar dari 21 kecamatan menegaskan komitmen pendampingan hukum dan penataan pedagang kaki lima tanpa penggusuran sepihak.',
                'konten' => '<p>Pangkalan Balai — DPD APPSI Kabupaten Banyuasin menyelenggarakan Rapat Koordinasi dan Konsolidasi Pengurus Komisariat Pasar (PKP) se-Kabupaten Banyuasin yang bertempat di Sekretariat DPD, Jl. Merdeka.</p><p>Agenda penting ini dihadiri oleh perwakilan pengurus pasar Pangkalan Balai, Betung, Mariana, Sukajadi, Sungai Dua, Makarti Jaya, dan Sungsang. Fokus bahasan meliputi perlindungan hak penempatan kios, harmonisasi tarif retribusi pasar, serta bantuan hukum cuma-cuma bagi pedagang yang mengalami sengketa zonasi lapak.</p><p>H. Gusra Yetri, SH menegaskan bahwa APPSI memegang prinsip dialog kemitraan konstruktif dengan aparat penegak perda dan pengelola pasar daerah.</p>',
                'gambar' => 'assets/images/berita/berita-musyawarah-appsi.jpg',
                'status' => 'published',
                'views_count' => 354,
                'published_at' => now()->subDays(7),
            ],
            [
                'judul' => 'Peluncuran Sistem KTA Digital dan Layanan Pengaduan Cepat Pedagang Pasar Banyuasin',
                'slug' => 'peluncuran-sistem-kta-digital-dan-layanan-pengaduan-cepat-pedagang-pasar-banyuasin',
                'kategori' => 'Layanan Anggota',
                'penulis' => 'Tim MIS DPD APPSI',
                'ringkasan' => 'Inovasi kartu tanda anggota berbasis QR Code dan portal pengaduan aspirasi resmi DPD APPSI Banyuasin kini dapat diakses secara online oleh seluruh pedagang binaan.',
                'konten' => '<p>Pangkalan Balai — Sebagai wujud tata kelola organisasi modern dan transparan, DPD APPSI Kabupaten Banyuasin secara resmi merilis portal digital <strong>appsiba.or.id</strong>.</p><p>Melalui platform ini, pedagang pasar di seluruh pelosok Banyuasin dapat mendaftar KTA secara online, mencetak kartu digital ber-QR Code resmi, mengecek status keabsahan surat rekomendasi, serta menyampaikan aduan seputar fasilitas pasar secara langsung kepada pengurus DPD.</p><p>"Kini setiap pedagang anggota APPSI memiliki identitas resmi yang terverifikasi, memudahkan koordinasi bantuan pemerintah dan akses kemitraan strategis lainnya," pungkas pengurus sekretariat.</p>',
                'gambar' => 'assets/images/berita/munas-appsi.jpg',
                'status' => 'published',
                'views_count' => 512,
                'published_at' => now()->subDays(9),
            ],
        ];

        foreach ($posts as $p) {
            Post::create($p);
        }

        // 6. Galleries (Dokumentasi Aksi & Kegiatan DPD APPSI Banyuasin)
        Gallery::query()->delete();
        $galleries = [
            [
                'judul' => 'Sosialisasi Digitalisasi QRIS di Pasar Pangkalan Balai',
                'deskripsi' => 'Edukasi penggunaan sistem pembayaran non-tunai bersama pengurus APPSI dan perbankan daerah.',
                'foto' => 'assets/images/berita/berita-qris-digital.jpg',
                'kategori' => 'Digitalisasi Pasar',
                'tanggal_kegiatan' => '2026-09-03',
            ],
            [
                'judul' => 'Operasi Pangan Murah Sembako di Pasar Betung',
                'deskripsi' => 'Pengawalan distribusi beras dan minyak goreng bersubsidi untuk menjaga stabilitas harga pangan rakyat.',
                'foto' => 'assets/images/berita/berita-operasi-pasar.jpg',
                'kategori' => 'Stabilisasi Pangan',
                'tanggal_kegiatan' => '2026-09-04',
            ],
            [
                'judul' => 'Pendampingan Permodalan Usaha Pedagang Pasar Sukajadi',
                'deskripsi' => 'Dialog penguatan modal kerja tanpa agunan memberatkan bersama mitra perbankan BUMN.',
                'foto' => 'assets/images/berita/berita-permodalan-kur.jpg',
                'kategori' => 'Permodalan KUR',
                'tanggal_kegiatan' => '2026-08-28',
            ],
            [
                'judul' => 'Survei Drainase & Kebersihan Los Basah Pasar Sungsang',
                'deskripsi' => 'Peninjauan sarana sanitasi dan saluran air pembuangan di sentra penjualan ikan segar muara.',
                'foto' => 'assets/images/berita/berita-pasar-sungsang.jpg',
                'kategori' => 'Advokasi Pasar',
                'tanggal_kegiatan' => '2026-08-20',
            ],
            [
                'judul' => 'Rembug Akbar Pengurus Komisariat Pasar se-Kabupaten Banyuasin',
                'deskripsi' => 'Konsolidasi organisasi pengurus pasar tradisional dalam memperjuangkan hak dan kenyamanan pedagang.',
                'foto' => 'assets/images/berita/berita-musyawarah-appsi.jpg',
                'kategori' => 'Konsolidasi',
                'tanggal_kegiatan' => '2026-08-15',
            ],
            [
                'judul' => 'Sosialisasi Program KTA Digital dan Hotline Bantuan Hukum APPSI',
                'deskripsi' => 'Pengenalan kartu keanggotaan digital terintegrasi barcode untuk pedagang pasar rakyat Banyuasin.',
                'foto' => 'assets/images/berita/munas-appsi.jpg',
                'kategori' => 'Layanan Anggota',
                'tanggal_kegiatan' => '2026-08-10',
            ],
        ];

        foreach ($galleries as $gal) {
            Gallery::create($gal);
        }

        // 7. Meetings (Agenda Rapat & Notulen APPSI Banyuasin)
        Meeting::query()->delete();
        Meeting::create([
            'judul_rapat' => 'Rapat Koordinasi Pengurus DPD Terkait Penataan Zonasi Kios & Stabilitas Harga Pasar',
            'tanggal' => '2026-08-25',
            'waktu_mulai' => '09:00:00',
            'waktu_selesai' => '12:00:00',
            'tempat' => 'Sekretariat DPD APPSI Kabupaten Banyuasin, Jl. Merdeka Pangkalan Balai',
            'pimpinan_rapat' => 'H. Gusra Yetri, SH',
            'notulis' => 'M. Rian Pratama, S.E.',
            'agenda' => "1. Pembahasan laporan harga pangan sembako mingguan.\n2. Penataan penempatan lapak pedagang kaki lima agar tidak mengganggu arus jalan masuk pasar.\n3. Program pendaftaran KTA digital bagi seluruh pedagang pasar.",
            'pembahasan' => 'Ketua memaparkan situasi pasar terkini. Disepakati pembentukan tim advokasi pasar dan fasilitasi dialog dengan pengelola pasar Pemkab.',
            'keputusan' => "1. Melakukan inventarisasi dan pendataan ulang anggota pedagang pasar di Pangkalan Balai dan Betung.\n2. Mengirimkan surat permohonan audiensi ke Pj Bupati Banyuasin dan Kadis Perindagkop.\n3. Peluncuran portal online pendaftaran keanggotaan APPSI.",
            'jumlah_hadir' => 15,
            'daftar_hadir' => "1. H. Gusra Yetri, SH (Ketua DPD)\n2. H. Ahmad Basir, S.E. (Waket I)\n3. Drs. Zulkarnain (Waket II)\n4. M. Rian Pratama, S.E. (Sekretaris)\n5. Hj. Siti Aminah (Bendahara)\n6. H. Burhanudin (Koordinator Sarana)\n7. Robi Chandra (Pasar Pangkalan Balai)\n8. Usman Effendi (Pasar Betung)\n9. Marzuki (Pasar Mariana)\n10. Pengurus Bidang lainnya.",
            'status' => 'selesai',
        ]);

        // 8. Outgoing Letters (Surat Keluar Generator Ber-KOP APPSI Banyuasin)
        Letter::query()->delete();
        $hash1 = strtoupper(substr(hash('sha256', '001/DPD-APPSI/BA/IX/2026'.time()), 0, 16));
        Letter::create([
            'uuid' => (string) Str::uuid(),
            'nomor_surat' => '001/DPD-APPSI/BA/IX/2026',
            'tanggal' => '2026-09-02',
            'jenis_surat' => 'AUDIENSI',
            'tujuan' => 'Kepala Dinas Koperasi, UKM dan Perdagangan Kabupaten Banyuasin',
            'keperluan' => 'Permohonan Audiensi dan Koordinasi Program Revitalisasi Pasar Tradisional',
            'perihal' => 'Permohonan Audiensi Pengurus DPD APPSI Kabupaten Banyuasin',
            'tempat_tujuan' => 'Kompleks Perkantoran Pemerintah Kabupaten Banyuasin',
            'nama_pejabat' => 'Kepala Dinas Koperindag Kab. Banyuasin',
            'jabatan_pejabat' => 'Kepala Dinas',
            'alamat_tujuan' => 'Pangkalan Balai',
            'lokasi' => 'Pangkalan Balai',
            'lampiran' => '1 (Satu) Berkas Susunan Pengurus',
            'tembusan' => "1. Yth. Bupati Banyuasin (sebagai laporan)\n2. Dewan Pertimbangan DPD APPSI Banyuasin\n3. Arsip",
            'nama_penandatangan' => 'H. Gusra Yetri, SH',
            'jabatan_penandatangan' => 'Ketua DPD APPSI Banyuasin',
            'nama_sekretaris' => 'M. Rian Pratama, S.E.',
            'jabatan_sekretaris' => 'Sekretaris DPD APPSI Banyuasin',
            'isi_surat' => 'Sehubungan dengan telah dikukuhkannya kepengurusan Dewan Pimpinan Daerah Asosiasi Pedagang Pasar Seluruh Indonesia (DPD APPSI) Kabupaten Banyuasin Periode 2024–2029, bersama ini kami bermaksud mengajukan permohonan audiensi guna menjalin sinergi dan menyampaikan aspirasi para pedagang pasar tradisional di Kabupaten Banyuasin.',
            'hash_keabsahan' => $hash1,
            'status' => 'terkirim',
        ]);

        // 9. Inboxes (Buku Tamu Masuk)
        Inbox::query()->delete();
        Inbox::create([
            'tanggal' => now()->subDay(),
            'nama' => 'Bambang Irawan',
            'instansi' => 'Paguyuban Pedagang Los Ikan Pangkalan Balai',
            'email' => 'bambang.ikan@yahoo.com',
            'telepon' => '0813-9900-1122',
            'tujuan' => 'Ketua DPD APPSI Kabupaten Banyuasin',
            'keperluan' => 'Usulan Perbaikan Saluran Air di Los Ikan',
            'pesan' => 'Assalamu\'alaikum Pak Ketua Gusra Yetri. Kami pedagang los ikan di Pasar Baru Pangkalan Balai memohon bantuan APPSI untuk menyampaikan usulan perbaikan drainase los ikan yang sering tersumbat saat hujan lebat. Terima kasih.',
            'status' => 'baru',
        ]);
    }
}
