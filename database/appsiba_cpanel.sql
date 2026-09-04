-- =====================================================================
-- PANGKALAN DATA RESMI MIS APPSI KABUPATEN BANYUASIN
-- Asosiasi Pedagang Pasar Seluruh Indonesia (appsiba.or.id)
-- Format: MySQL 8.0+ / MariaDB 10.3+ (InnoDB, utf8mb4_unicode_ci)
-- Siap import langsung di cPanel phpMyAdmin
-- Waktu Pembuatan: 2026-09-04
-- =====================================================================

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+07:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------
-- Struktur Tabel `users`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data untuk tabel `users`
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
('1', 'Administrator APPSI Banyuasin', 'admin@appsiba.or.id', '2026-09-04 13:37:00', '$2y$12$v6CPYzxAA27hK/PR5SH2iudIe4FXib/9nGNV/EZ.FkD8zorfnqKte', NULL, '2026-09-03 14:48:56', '2026-09-04 13:37:00');


-- --------------------------------------------------------
-- Struktur Tabel `password_reset_tokens`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------
-- Struktur Tabel `sessions`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `payload` longtext NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------
-- Struktur Tabel `cache`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------
-- Struktur Tabel `cache_locks`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------
-- Struktur Tabel `jobs`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------
-- Struktur Tabel `job_batches`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------
-- Struktur Tabel `failed_jobs`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------
-- Struktur Tabel `members`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `nik` varchar(20) DEFAULT NULL,
  `nomor_anggota` varchar(255) DEFAULT NULL,
  `nama_usaha` varchar(255) NOT NULL,
  `jenis_usaha` varchar(255) NOT NULL,
  `bentuk_usaha` varchar(255) NOT NULL DEFAULT 'Kios',
  `lokasi_pasar` varchar(255) NOT NULL DEFAULT 'Pasar Pangkalan Balai',
  `blok_nomor` varchar(255) DEFAULT NULL,
  `no_hp` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `alamat_domisili` text,
  `foto` varchar(255) DEFAULT NULL,
  `foto_usaha` varchar(255) DEFAULT NULL,
  `terdaftar_sejak` date DEFAULT NULL,
  `status` enum('aktif','verifikasi','tidak_aktif') NOT NULL DEFAULT 'aktif',
  `catatan` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `members_nomor_anggota_unique` (`nomor_anggota`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data untuk tabel `members`
INSERT INTO `members` (`id`, `nama`, `nik`, `nomor_anggota`, `nama_usaha`, `jenis_usaha`, `bentuk_usaha`, `lokasi_pasar`, `blok_nomor`, `no_hp`, `email`, `alamat_domisili`, `foto`, `foto_usaha`, `terdaftar_sejak`, `status`, `catatan`, `created_at`, `updated_at`) VALUES
('31', 'H. Gusra Yetri, SH', '1607011205730001', 'DPD-BA-01.0001', 'Toko Sembako Berkah Maju', 'Sembako & Kebutuhan Pokok', 'Kios', 'Pasar Pangkalan Balai', 'Blok A No. 01-02', '0811 618 808', 'gusra.yetri@appsiba.or.id', 'Kel. Pangkalan Balai, Banyuasin III', 'assets/images/default-avatar-gray.png', NULL, '2020-01-15 00:00:00', 'aktif', 'Ketua DPD APPSI Kabupaten Banyuasin', '2026-09-04 13:37:00', '2026-09-04 13:37:00'),
('32', 'Hj. Rohana', '1607014508750002', 'DPD-BA-01.0002', 'Kios Sayur Segar Bumi Lestari', 'Sayur, Buah & Hasil Bumi', 'Los', 'Pasar Pangkalan Balai', 'Los Sayur No. 08', '0813-7722-1144', 'rohana.sayur@gmail.com', 'Desa Tanjung Kepayang, Banyuasin III', 'assets/images/default-avatar-gray.png', NULL, '2021-03-10 00:00:00', 'aktif', 'Pemasok sayur mayur lokal dataran Banyuasin', '2026-09-04 13:37:00', '2026-09-04 13:37:00'),
('33', 'Slamet Riyadi', '1607021504800003', 'DPD-BA-01.0003', 'Daging Sapi & Kambing Barokah Jaya', 'Daging, Unggas & Ikan Segar', 'Kios', 'Pasar Betung', 'Blok Daging No. 04', '0821-8877-3322', 'slamet.daging@gmail.com', 'Kel. Rimba Asam, Betung', 'assets/images/default-avatar-gray.png', NULL, '2021-06-20 00:00:00', 'aktif', 'Sertifikasi Halal RPH terverifikasi', '2026-09-04 13:37:00', '2026-09-04 13:37:00'),
('34', 'M. Yusuf Ridho', '1607011003880004', 'DPD-BA-01.0004', 'Busana Muslimah Siti Khadijah', 'Pakaian, Konveksi & Tekstil', 'Kios', 'Pasar Pangkalan Balai', 'Blok B No. 14', '0852-6789-0011', 'yusuf.busana@gmail.com', 'Kel. Mulia Agung, Banyuasin III', 'assets/images/default-avatar-gray.png', NULL, '2022-01-10 00:00:00', 'aktif', 'Menjual aneka busana muslim, gamis, dan batik Banyuasin', '2026-09-04 13:37:00', '2026-09-04 13:37:00'),
('35', 'Ibu Mardiana', '1607036012780005', 'DPD-BA-01.0005', 'Warung Pindang Pegagan & Kuliner Pasar', 'Kuliner & Jajanan Tradisional', 'Kios', 'Pasar Mariana', 'Kios Kuliner No. 02', '0812-7311-5566', 'mardiana.kuliner@gmail.com', 'Kel. Mariana, Banyuasin I', 'assets/images/default-avatar-gray.png', NULL, '2022-04-18 00:00:00', 'aktif', 'Pusat jajanan dan lauk pauk tradisional pasar', '2026-09-04 13:37:00', '2026-09-04 13:37:00'),
('36', 'H. Thamrin', '1607022209700006', 'DPD-BA-01.0006', 'Grosir Beras & Gula Saudara', 'Sembako & Kebutuhan Pokok', 'Ruko Pasar', 'Pasar Betung', 'Ruko Pasar No. 05-06', '0813-7890-4455', 'thamrin.grosir@gmail.com', 'Kecamatan Betung, Banyuasin', 'assets/images/default-avatar-gray.png', NULL, '2020-08-01 00:00:00', 'aktif', 'Distributor beras lokal dataran Banyuasin', '2026-09-04 13:37:00', '2026-09-04 13:37:00'),
('37', 'Edi Santoso', '1607011906840007', 'DPD-BA-01.0007', 'Kelontong & Alat Rumah Tangga Mandiri', 'Kelontong & Aneka Plastik', 'Kios', 'Pasar Pangkalan Balai', 'Blok C No. 09', '0822-7901-2345', 'edi.kelontong@gmail.com', 'Kel. Kedondong Raye, Banyuasin III', 'assets/images/default-avatar-gray.png', NULL, '2022-08-14 00:00:00', 'aktif', 'Menyediakan perkakas plastik, pecah belah, dan kebutuhan harian', '2026-09-04 13:37:00', '2026-09-04 13:37:00'),
('38', 'Andi Wijaya', '1607051411900008', 'DPD-BA-01.0008', 'Servis Elektronik & Jam Cahaya Terang', 'Elektronik, Servis & Aneka Jasa', 'Kios', 'Pasar Sukajadi (Talang Kelapa)', 'Blok Jasa No. 03', '0852-7899-1212', 'andi.servis@gmail.com', 'Kel. Sukajadi, Talang Kelapa', 'assets/images/default-avatar-gray.png', NULL, '2023-02-11 00:00:00', 'aktif', 'Jasa perbaikan kelistrikan dan suku cadang alat rumah tangga', '2026-09-04 13:37:00', '2026-09-04 13:37:00'),
('39', 'Cik Maryam', '1607045501820009', 'DPD-BA-01.0009', 'Aneka Ikan Segar & Udang Sungai Sungsang', 'Daging, Unggas & Ikan Segar', 'Los', 'Pasar Sungsang', 'Los Basah No. 11', '0812-7188-4400', 'maryam.ikan@gmail.com', 'Desa Sungsang I, Banyuasin II', 'assets/images/default-avatar-gray.png', NULL, '2023-05-19 00:00:00', 'aktif', 'Hasil tangkapan nelayan pesisir muara Banyuasin', '2026-09-04 13:37:00', '2026-09-04 13:37:00'),
('40', 'Herman Syafei', '1607021102860010', 'DPD-BA-01.0010', 'Kios Buah Segar Nusantara', 'Sayur, Buah & Hasil Bumi', 'Los', 'Pasar Betung', 'Los Buah No. 07', '0853-6677-8899', 'herman.buah@gmail.com', 'Desa Lubuk Karet, Betung', 'assets/images/default-avatar-gray.png', NULL, '2023-09-05 00:00:00', 'aktif', 'Aneka buah segar lokal dan pilihan', '2026-09-04 13:37:00', '2026-09-04 13:37:00');


-- --------------------------------------------------------
-- Struktur Tabel `member_registrations`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `member_registrations`;
CREATE TABLE IF NOT EXISTS `member_registrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `nama_usaha` varchar(255) NOT NULL,
  `jenis_usaha` varchar(255) NOT NULL,
  `bentuk_usaha` varchar(255) NOT NULL DEFAULT 'Kios',
  `lokasi_pasar` varchar(255) NOT NULL,
  `blok_nomor` varchar(255) DEFAULT NULL,
  `alamat_domisili` text NOT NULL,
  `foto_ktp` varchar(255) DEFAULT NULL,
  `foto_usaha` varchar(255) DEFAULT NULL,
  `status` enum('menunggu_verifikasi','disetujui','ditolak') NOT NULL DEFAULT 'menunggu_verifikasi',
  `catatan_admin` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------
-- Struktur Tabel `organization_structures`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `organization_structures`;
CREATE TABLE IF NOT EXISTS `organization_structures` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `divisi` varchar(255) DEFAULT NULL,
  `urutan` int NOT NULL DEFAULT '0',
  `periode` varchar(255) NOT NULL DEFAULT '2024 - 2029',
  `foto` varchar(255) DEFAULT NULL,
  `no_hp` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data untuk tabel `organization_structures`
INSERT INTO `organization_structures` (`id`, `nama`, `jabatan`, `divisi`, `urutan`, `periode`, `foto`, `no_hp`, `email`, `created_at`, `updated_at`) VALUES
('53', 'H. Gusra Yetri, SH', 'Ketua DPD', 'Pimpinan Harian', '1', '2024 - 2029', 'assets/images/ketua-appsi-banyuasin.webp', '0811 618 808', 'gusra.yetri@appsiba.or.id', '2026-09-04 13:37:00', '2026-09-04 13:37:00'),
('54', 'H. Ahmad Basir, S.E.', 'Wakil Ketua I (Organisasi & Keanggotaan)', 'Pimpinan Harian', '2', '2024 - 2029', 'assets/images/default-avatar-gray.png', '0813-7301-4422', 'ahmad.basir@appsiba.or.id', '2026-09-04 13:37:00', '2026-09-04 13:37:00'),
('55', 'Drs. Zulkarnain', 'Wakil Ketua II (Advokasi & Hukum Pedagang)', 'Pimpinan Harian', '3', '2024 - 2029', 'assets/images/default-avatar-gray.png', '0821-8890-1122', 'zulkarnain@appsiba.or.id', '2026-09-04 13:37:00', '2026-09-04 13:37:00'),
('56', 'Ir. H. Syamsudin', 'Wakil Ketua III (Kemitraan, Perbankan & UMKM)', 'Pimpinan Harian', '4', '2024 - 2029', 'assets/images/default-avatar-gray.png', '0812-7100-3344', 'syamsudin@appsiba.or.id', '2026-09-04 13:37:00', '2026-09-04 13:37:00'),
('57', 'M. Rian Pratama, S.E.', 'Sekretaris Umum', 'Sekretariat', '5', '2024 - 2029', 'assets/images/default-avatar-gray.png', '0852-6711-2233', 'sekretaris@appsiba.or.id', '2026-09-04 13:37:00', '2026-09-04 13:37:00'),
('58', 'Hendra Gunawan', 'Wakil Sekretaris', 'Sekretariat', '6', '2024 - 2029', 'assets/images/default-avatar-gray.png', '0822-8119-0099', 'hendra@appsiba.or.id', '2026-09-04 13:37:00', '2026-09-04 13:37:00'),
('59', 'Hj. Siti Aminah', 'Bendahara Umum', 'Kebendaharaan', '7', '2024 - 2029', 'assets/images/default-avatar-gray.png', '0813-6800-4411', 'bendahara@appsiba.or.id', '2026-09-04 13:37:00', '2026-09-04 13:37:00'),
('60', 'Nurhayati, S.Sos.', 'Wakil Bendahara', 'Kebendaharaan', '8', '2024 - 2029', 'assets/images/default-avatar-gray.png', '0813-7766-5544', 'nurhayati@appsiba.or.id', '2026-09-04 13:37:00', '2026-09-04 13:37:00'),
('61', 'H. Burhanudin', 'Koordinator Bidang Sarana & Penataan Pasar', 'Bidang Sarana Pasar', '9', '2024 - 2029', 'assets/images/default-avatar-gray.png', '0853-8822-1133', 'burhanudin@appsiba.or.id', '2026-09-04 13:37:00', '2026-09-04 13:37:00'),
('62', 'Siti Fatimah', 'Koordinator Pemberdayaan Pedagang Wanita', 'Bidang Pemberdayaan Perempuan', '10', '2024 - 2029', 'assets/images/default-avatar-gray.png', '0821-9988-7711', 'siti.fatimah@appsiba.or.id', '2026-09-04 13:37:00', '2026-09-04 13:37:00'),
('63', 'Robi Chandra', 'Ketua Komisariat Pasar Pangkalan Balai', 'Komisariat Pasar', '11', '2024 - 2029', 'assets/images/default-avatar-gray.png', '0812-7722-3344', 'pasar.pangkalanbalai@appsiba.or.id', '2026-09-04 13:37:00', '2026-09-04 13:37:00'),
('64', 'Usman Effendi', 'Ketua Komisariat Pasar Betung', 'Komisariat Pasar', '12', '2024 - 2029', 'assets/images/default-avatar-gray.png', '0813-8833-2211', 'pasar.betung@appsiba.or.id', '2026-09-04 13:37:00', '2026-09-04 13:37:00'),
('65', 'Marzuki', 'Ketua Komisariat Pasar Mariana', 'Komisariat Pasar', '13', '2024 - 2029', 'assets/images/default-avatar-gray.png', '0852-7711-9900', 'pasar.mariana@appsiba.or.id', '2026-09-04 13:37:00', '2026-09-04 13:37:00');


-- --------------------------------------------------------
-- Struktur Tabel `posts`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL DEFAULT 'Kegiatan Pasar',
  `penulis` varchar(255) NOT NULL DEFAULT 'H. Gusra Yetri, SH',
  `ringkasan` text,
  `konten` longtext NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `status` enum('draft','published') NOT NULL DEFAULT 'published',
  `views_count` int NOT NULL DEFAULT '0',
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data untuk tabel `posts`
INSERT INTO `posts` (`id`, `judul`, `slug`, `kategori`, `penulis`, `ringkasan`, `konten`, `gambar`, `status`, `views_count`, `published_at`, `created_at`, `updated_at`) VALUES
('17', 'DPD APPSI Banyuasin Akselerasi Digitalisasi Pasar dan Pembayaran QRIS di Pasar Pangkalan Balai', 'dpd-appsi-banyuasin-akselerasi-digitalisasi-pasar-dan-pembayaran-qris-di-pasar-pangkalan-balai', 'Digitalisasi Pasar', 'Humas DPD Banyuasin', 'DPD APPSI Banyuasin bersama Bank Sumsel Babel dan Dinas Perindagkop memfasilitasi ratusan pedagang pasar tradisional mengadopsi sistem transaksi digital non-tunai QRIS.', '<p>Pangkalan Balai — Dewan Pimpinan Daerah Asosiasi Pedagang Pasar Seluruh Indonesia (DPD APPSI) Kabupaten Banyuasin secara resmi meluncurkan inisiatif percepatan transformasi digital bagi para pedagang di Pasar Pangkalan Balai.</p><p>Ketua DPD APPSI Kabupaten Banyuasin, <strong>H. Gusra Yetri, SH</strong>, didampingi perwakilan perbankan daerah dan Dinas Perdagangan, Koperasi, dan UKM Kabupaten Banyuasin, turun langsung ke blok sembako dan pakaian untuk mendampingi aktivasi kode QRIS pedagang.</p><p>\"Pasar tradisional tidak boleh tertinggal oleh pesatnya era ekonomi digital. Dengan QRIS, pedagang pasar kita tidak perlu repot mencari uang kembalian, transaksi tercatat otomatis, serta terhindar dari risiko uang palsu,\" ujar H. Gusra Yetri di sela-sela peninjauan kios.</p><p>Program ini ditargetkan menjangkau lebih dari 450 pedagang di 3 pasar percontohan dalam kurun waktu semester pertama kepengurusan.</p>', 'assets/images/berita/berita-qris-digital.jpg', 'published', '428', '2026-09-03 13:37:00', '2026-09-04 13:37:00', '2026-09-04 13:37:00'),
('18', 'Gelar Operasi Pasar Pangan Murah di Betung, APPSI Banyuasin Kawal Stabilitas Harga Beras dan Minyak Goreng', 'gelar-operasi-pasar-pangan-murah-di-betung-appsi-banyuasin-kawal-stabilitas-harga-beras-dan-minyak-goreng', 'Stabilisasi Pangan', 'M. Rian Pratama, S.E.', 'Upaya konkret menekan lonjakan inflasi bahan pokok di jalur lintas timur, APPSI Banyuasin bersinergi mendistribusikan ribuan liter minyak goreng dan beras medium berkualitas.', '<p>Betung — Menanggapi fluktuasi harga kebutuhan pokok di wilayah perbatasan dan jalur lintas Sumatra, DPD APPSI Banyuasin menggelar aksi tanggap stabilitas pasokan pangan murah di kawasan Pasar Betung.</p><p>Aksi ini melibatkan kolaborasi langsung antara para pedagang grosir sembako lokal anggota APPSI dengan distributor resmi produsen pangan daerah. Penjualan paket beras SPHP dan minyak goreng bersubsidi berlangsung tertib dan disambut antusias oleh para pedagang eceran maupun pembeli rumah tangga.</p><p>Sekretaris DPD APPSI Banyuasin, <strong>M. Rian Pratama, S.E.</strong>, menegaskan komitmen APPSI dalam memotong rantai distribusi yang berbelit-belit agar harga jual di tingkat lapak pedagang tetap terjangkau dan menguntungkan kedua belah pihak.</p>', 'assets/images/berita/berita-operasi-pasar.jpg', 'published', '390', '2026-09-02 13:37:00', '2026-09-04 13:37:00', '2026-09-04 13:50:13'),
('19', 'Bebaskan Pedagang dari Rentenir, APPSI Banyuasin Buka Akses KUR Tanpa Agunan Tambahan di Sukajadi', 'bebaskan-pedagang-dari-rentenir-appsi-banyuasin-buka-akses-kur-tanpa-agunan-tambahan-di-sukajadi', 'Permodalan KUR', 'Bidang Kemitraan UMKM', 'DPD APPSI memfasilitasi program pembiayaan Kredit Usaha Rakyat (KUR) berbunga rendah untuk modal kerja pedagang Pasar Sukajadi Talang Kelapa.', '<p>Talang Kelapa — Praktik pinjaman berbunga tinggi atau rentenir harian sering kali menjadi jeratan berat bagi kelangsungan usaha pedagang pasar tradisional. Menyikapi persoalan ini, DPD APPSI Kabupaten Banyuasin menggelar sosialisasi dan pendampingan pengajuan KUR Perbankan di Pasar Sukajadi.</p><p>Melalui rekomendasi keanggotaan KTA APPSI, para pedagang mendapatkan asistensi pemberkasan izin usaha nomor induk berusaha (NIB) serta kelayakan pembukuan sederhana, sehingga proses pencairan modal kerja dapat berjalan cepat dan transparan.</p><p>\"Misi utama APPSI adalah melindungi ekonomi pedagang kecil. Kami ingin modal kerja pedagang bertumbuh sehat lewat jalur perbankan formal yang dilindungi pemerintah,\" terang perwakilan Bidang Kemitraan DPD APPSI Banyuasin.</p>', 'assets/images/berita/berita-permodalan-kur.jpg', 'published', '312', '2026-08-31 13:37:00', '2026-09-04 13:37:00', '2026-09-04 13:37:00'),
('20', 'Advokasi Sanitasi & Revitalisasi Drainase Pasar Sungsang Demi Kenyamanan Pedagang dan Pembeli', 'advokasi-sanitasi-revitalisasi-drainase-pasar-sungsang-demi-kenyamanan-pedagang-dan-pembeli', 'Advokasi Pasar', 'Bidang Sarana & Prasarana', 'APPSI mengawal aspirasi pedagang los basah ikan dan hasil laut Sungsang terkait perbaikan sistem saluran pembuangan air dan dermaga bongkar muat.', '<p>Banyuasin II — Pasar Sungsang yang terkenal sebagai sentra perdagangan hasil laut dan ikan segar di pesisir muara Banyuasin memerlukan perhatian khusus pada sarana sanitasi dan drainase pembuangan air asin.</p><p>Tim advokasi DPD APPSI Banyuasin bersama pengurus Komisariat Pasar (PKP) Sungsang melakukan survei lapangan dan menyusun draf rekomendasi teknis perbaikan fasilitas saluran kepada instansi terkait.</p><p>Langkah ini penting agar kebersihan pasar tetap terjaga, aroma tidak mengganggu pemukiman sekitar, serta dermaga sandar kapal pembawa pasokan ikan nelayan dapat beroperasi dengan aman saat pasang surut air laut.</p>', 'assets/images/berita/berita-pasar-sungsang.jpg', 'published', '276', '2026-08-30 13:37:00', '2026-09-04 13:37:00', '2026-09-04 13:37:00'),
('21', 'Konsolidasi Komisariat Pasar (PKP) se-Banyuasin: Perkuat Soliditas & Payung Perlindungan Hukum', 'konsolidasi-komisariat-pasar-pkp-se-banyuasin-perkuat-soliditas-payung-perlindungan-hukum', 'Organisasi', 'Humas DPD Banyuasin', 'Rapat konsolidasi pengurus komisariat pasar dari 21 kecamatan menegaskan komitmen pendampingan hukum dan penataan pedagang kaki lima tanpa penggusuran sepihak.', '<p>Pangkalan Balai — DPD APPSI Kabupaten Banyuasin menyelenggarakan Rapat Koordinasi dan Konsolidasi Pengurus Komisariat Pasar (PKP) se-Kabupaten Banyuasin yang bertempat di Sekretariat DPD, Jl. Merdeka.</p><p>Agenda penting ini dihadiri oleh perwakilan pengurus pasar Pangkalan Balai, Betung, Mariana, Sukajadi, Sungai Dua, Makarti Jaya, dan Sungsang. Fokus bahasan meliputi perlindungan hak penempatan kios, harmonisasi tarif retribusi pasar, serta bantuan hukum cuma-cuma bagi pedagang yang mengalami sengketa zonasi lapak.</p><p>H. Gusra Yetri, SH menegaskan bahwa APPSI memegang prinsip dialog kemitraan konstruktif dengan aparat penegak perda dan pengelola pasar daerah.</p>', 'assets/images/berita/berita-musyawarah-appsi.jpg', 'published', '354', '2026-08-28 13:37:00', '2026-09-04 13:37:00', '2026-09-04 13:37:00'),
('22', 'Peluncuran Sistem KTA Digital dan Layanan Pengaduan Cepat Pedagang Pasar Banyuasin', 'peluncuran-sistem-kta-digital-dan-layanan-pengaduan-cepat-pedagang-pasar-banyuasin', 'Layanan Anggota', 'Tim MIS DPD APPSI', 'Inovasi kartu tanda anggota berbasis QR Code dan portal pengaduan aspirasi resmi DPD APPSI Banyuasin kini dapat diakses secara online oleh seluruh pedagang binaan.', '<p>Pangkalan Balai — Sebagai wujud tata kelola organisasi modern dan transparan, DPD APPSI Kabupaten Banyuasin secara resmi merilis portal digital <strong>appsiba.or.id</strong>.</p><p>Melalui platform ini, pedagang pasar di seluruh pelosok Banyuasin dapat mendaftar KTA secara online, mencetak kartu digital ber-QR Code resmi, mengecek status keabsahan surat rekomendasi, serta menyampaikan aduan seputar fasilitas pasar secara langsung kepada pengurus DPD.</p><p>\"Kini setiap pedagang anggota APPSI memiliki identitas resmi yang terverifikasi, memudahkan koordinasi bantuan pemerintah dan akses kemitraan strategis lainnya,\" pungkas pengurus sekretariat.</p>', 'assets/images/berita/munas-appsi.jpg', 'published', '512', '2026-08-26 13:37:00', '2026-09-04 13:37:00', '2026-09-04 13:37:00');


-- --------------------------------------------------------
-- Struktur Tabel `galleries`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `galleries`;
CREATE TABLE IF NOT EXISTS `galleries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text,
  `foto` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL DEFAULT 'Kegiatan',
  `tanggal_kegiatan` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data untuk tabel `galleries`
INSERT INTO `galleries` (`id`, `judul`, `deskripsi`, `foto`, `kategori`, `tanggal_kegiatan`, `created_at`, `updated_at`) VALUES
('17', 'Sosialisasi Digitalisasi QRIS di Pasar Pangkalan Balai', 'Edukasi penggunaan sistem pembayaran non-tunai bersama pengurus APPSI dan perbankan daerah.', 'assets/images/berita/berita-qris-digital.jpg', 'Digitalisasi Pasar', '2026-09-03 00:00:00', '2026-09-04 13:37:00', '2026-09-04 13:37:00'),
('18', 'Operasi Pangan Murah Sembako di Pasar Betung', 'Pengawalan distribusi beras dan minyak goreng bersubsidi untuk menjaga stabilitas harga pangan rakyat.', 'assets/images/berita/berita-operasi-pasar.jpg', 'Stabilisasi Pangan', '2026-09-04 00:00:00', '2026-09-04 13:37:00', '2026-09-04 13:37:00'),
('19', 'Pendampingan Permodalan Usaha Pedagang Pasar Sukajadi', 'Dialog penguatan modal kerja tanpa agunan memberatkan bersama mitra perbankan BUMN.', 'assets/images/berita/berita-permodalan-kur.jpg', 'Permodalan KUR', '2026-08-28 00:00:00', '2026-09-04 13:37:00', '2026-09-04 13:37:00'),
('20', 'Survei Drainase & Kebersihan Los Basah Pasar Sungsang', 'Peninjauan sarana sanitasi dan saluran air pembuangan di sentra penjualan ikan segar muara.', 'assets/images/berita/berita-pasar-sungsang.jpg', 'Advokasi Pasar', '2026-08-20 00:00:00', '2026-09-04 13:37:00', '2026-09-04 13:37:00'),
('21', 'Rembug Akbar Pengurus Komisariat Pasar se-Kabupaten Banyuasin', 'Konsolidasi organisasi pengurus pasar tradisional dalam memperjuangkan hak dan kenyamanan pedagang.', 'assets/images/berita/berita-musyawarah-appsi.jpg', 'Konsolidasi', '2026-08-15 00:00:00', '2026-09-04 13:37:00', '2026-09-04 13:37:00'),
('22', 'Pengawasan Tera Ulang Timbangan Pasar Tradisional Pangkalan Balai', 'Kerjasama DPD APPSI dan Dinas Perindagkop memastikan ketepatan timbangan pedagang demi perlindungan konsumen.', 'assets/images/berita/kegiatan-timbangan-tera.jpg', 'Tera Timbangan', '2026-08-05 00:00:00', '2026-09-04 13:37:00', '2026-09-04 13:37:00'),
('23', 'Pelatihan Pembukuan Keuangan & Literasi Digital Pedagang Pasar Wanita', 'Pemberdayaan pedagang wanita pasar Banyuasin dalam pengelolaan keuangan usaha berbasis aplikasi digital.', 'assets/images/berita/kegiatan-pelatihan-wanita.jpg', 'Pelatihan UMKM', '2026-07-28 00:00:00', '2026-09-04 13:37:00', '2026-09-04 13:37:00');


-- --------------------------------------------------------
-- Struktur Tabel `letters`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `letters`;
CREATE TABLE IF NOT EXISTS `letters` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) DEFAULT NULL,
  `nomor_surat` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `jenis_surat` varchar(255) NOT NULL DEFAULT 'SURAT BIASA',
  `tujuan` varchar(255) NOT NULL,
  `keperluan` varchar(255) NOT NULL,
  `perihal` varchar(255) DEFAULT NULL,
  `tempat_tujuan` varchar(255) DEFAULT NULL,
  `nama_pejabat` varchar(255) DEFAULT NULL,
  `jabatan_pejabat` varchar(255) DEFAULT NULL,
  `alamat_tujuan` varchar(255) DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `lampiran` varchar(255) DEFAULT NULL,
  `tembusan` text,
  `nama_penandatangan` varchar(255) NOT NULL DEFAULT 'H. Gusra Yetri, SH',
  `jabatan_penandatangan` varchar(255) NOT NULL DEFAULT 'Ketua DPD APPSI Banyuasin',
  `nama_sekretaris` varchar(255) DEFAULT NULL,
  `jabatan_sekretaris` varchar(255) DEFAULT 'Sekretaris DPD APPSI Banyuasin',
  `isi_surat` longtext,
  `hash_keabsahan` varchar(255) DEFAULT NULL,
  `status` enum('draf','terkirim','selesai') NOT NULL DEFAULT 'terkirim',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `letters_nomor_surat_unique` (`nomor_surat`),
  UNIQUE KEY `letters_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data untuk tabel `letters`
INSERT INTO `letters` (`id`, `uuid`, `nomor_surat`, `tanggal`, `jenis_surat`, `tujuan`, `keperluan`, `perihal`, `tempat_tujuan`, `nama_pejabat`, `jabatan_pejabat`, `alamat_tujuan`, `lokasi`, `tanggal_mulai`, `tanggal_selesai`, `lampiran`, `tembusan`, `nama_penandatangan`, `jabatan_penandatangan`, `nama_sekretaris`, `jabatan_sekretaris`, `isi_surat`, `hash_keabsahan`, `status`, `created_at`, `updated_at`) VALUES
('4', '07555b9f-564e-4a93-8661-4cf02d451775', '001/DPD-APPSI/BA/IX/2026', '2026-09-02 00:00:00', 'AUDIENSI', 'Kepala Dinas Koperasi, UKM dan Perdagangan Kabupaten Banyuasin', 'Permohonan Audiensi dan Koordinasi Program Revitalisasi Pasar Tradisional', 'Permohonan Audiensi Pengurus DPD APPSI Kabupaten Banyuasin', 'Kompleks Perkantoran Pemerintah Kabupaten Banyuasin', 'Kepala Dinas Koperindag Kab. Banyuasin', 'Kepala Dinas', 'Pangkalan Balai', 'Pangkalan Balai', NULL, NULL, '1 (Satu) Berkas Susunan Pengurus', '1. Yth. Bupati Banyuasin (sebagai laporan)\n2. Dewan Pertimbangan DPD APPSI Banyuasin\n3. Arsip', 'H. Gusra Yetri, SH', 'Ketua DPD APPSI Banyuasin', 'M. Rian Pratama, S.E.', 'Sekretaris DPD APPSI Banyuasin', 'Sehubungan dengan telah dikukuhkannya kepengurusan Dewan Pimpinan Daerah Asosiasi Pedagang Pasar Seluruh Indonesia (DPD APPSI) Kabupaten Banyuasin Periode 2024–2029, bersama ini kami bermaksud mengajukan permohonan audiensi guna menjalin sinergi dan menyampaikan aspirasi para pedagang pasar tradisional di Kabupaten Banyuasin.', 'BD359DD8193C82FB', 'terkirim', '2026-09-04 13:37:00', '2026-09-04 13:37:00');


-- --------------------------------------------------------
-- Struktur Tabel `incoming_letters`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `incoming_letters`;
CREATE TABLE IF NOT EXISTS `incoming_letters` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nomor_surat` varchar(255) NOT NULL,
  `tanggal_surat` date NOT NULL,
  `tanggal_terima` date NOT NULL,
  `pengirim` varchar(255) NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `keterangan` text,
  `disposisi` varchar(255) DEFAULT NULL,
  `status` enum('baru','diproses','selesai') NOT NULL DEFAULT 'baru',
  `file_lampiran` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------
-- Struktur Tabel `meetings`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `meetings`;
CREATE TABLE IF NOT EXISTS `meetings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul_rapat` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_selesai` time DEFAULT NULL,
  `tempat` varchar(255) NOT NULL,
  `pimpinan_rapat` varchar(255) NOT NULL,
  `notulis` varchar(255) NOT NULL,
  `agenda` text NOT NULL,
  `pembahasan` longtext,
  `keputusan` longtext,
  `jumlah_hadir` int NOT NULL DEFAULT '0',
  `daftar_hadir` text,
  `status` enum('terjadwal','berlangsung','selesai') NOT NULL DEFAULT 'selesai',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data untuk tabel `meetings`
INSERT INTO `meetings` (`id`, `judul_rapat`, `tanggal`, `waktu_mulai`, `waktu_selesai`, `tempat`, `pimpinan_rapat`, `notulis`, `agenda`, `pembahasan`, `keputusan`, `jumlah_hadir`, `daftar_hadir`, `status`, `created_at`, `updated_at`) VALUES
('4', 'Rapat Koordinasi Pengurus DPD Terkait Penataan Zonasi Kios & Stabilitas Harga Pasar', '2026-08-25 00:00:00', '09:00:00', '12:00:00', 'Sekretariat DPD APPSI Kabupaten Banyuasin, Jl. Merdeka Pangkalan Balai', 'H. Gusra Yetri, SH', 'M. Rian Pratama, S.E.', '1. Pembahasan laporan harga pangan sembako mingguan.\n2. Penataan penempatan lapak pedagang kaki lima agar tidak mengganggu arus jalan masuk pasar.\n3. Program pendaftaran KTA digital bagi seluruh pedagang pasar.', 'Ketua memaparkan situasi pasar terkini. Disepakati pembentukan tim advokasi pasar dan fasilitasi dialog dengan pengelola pasar Pemkab.', '1. Melakukan inventarisasi dan pendataan ulang anggota pedagang pasar di Pangkalan Balai dan Betung.\n2. Mengirimkan surat permohonan audiensi ke Pj Bupati Banyuasin dan Kadis Perindagkop.\n3. Peluncuran portal online pendaftaran keanggotaan APPSI.', '15', '1. H. Gusra Yetri, SH (Ketua DPD)\n2. H. Ahmad Basir, S.E. (Waket I)\n3. Drs. Zulkarnain (Waket II)\n4. M. Rian Pratama, S.E. (Sekretaris)\n5. Hj. Siti Aminah (Bendahara)\n6. H. Burhanudin (Koordinator Sarana)\n7. Robi Chandra (Pasar Pangkalan Balai)\n8. Usman Effendi (Pasar Betung)\n9. Marzuki (Pasar Mariana)\n10. Pengurus Bidang lainnya.', 'selesai', '2026-09-04 13:37:00', '2026-09-04 13:37:00');


-- --------------------------------------------------------
-- Struktur Tabel `inboxes`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `inboxes`;
CREATE TABLE IF NOT EXISTS `inboxes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tanggal` datetime NOT NULL,
  `nama` varchar(255) NOT NULL,
  `instansi` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telepon` varchar(255) DEFAULT NULL,
  `tujuan` varchar(255) NOT NULL DEFAULT 'DPD APPSI Kabupaten Banyuasin',
  `keperluan` varchar(255) NOT NULL,
  `pesan` text NOT NULL,
  `status` enum('baru','dibaca','dibalas') NOT NULL DEFAULT 'baru',
  `balasan` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data untuk tabel `inboxes`
INSERT INTO `inboxes` (`id`, `tanggal`, `nama`, `instansi`, `email`, `telepon`, `tujuan`, `keperluan`, `pesan`, `status`, `balasan`, `created_at`, `updated_at`) VALUES
('4', '2026-09-03 13:37:00', 'Bambang Irawan', 'Paguyuban Pedagang Los Ikan Pangkalan Balai', 'bambang.ikan@yahoo.com', '0813-9900-1122', 'Ketua DPD APPSI Kabupaten Banyuasin', 'Usulan Perbaikan Saluran Air di Los Ikan', 'Assalamu\'alaikum Pak Ketua Gusra Yetri. Kami pedagang los ikan di Pasar Baru Pangkalan Balai memohon bantuan APPSI untuk menyampaikan usulan perbaikan drainase los ikan yang sering tersumbat saat hujan lebat. Terima kasih.', 'baru', NULL, '2026-09-04 13:37:00', '2026-09-04 13:37:00');


-- --------------------------------------------------------
-- Struktur Tabel `settings`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data untuk tabel `settings`
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
('1', 'nama_organisasi', 'Dewan Pimpinan Daerah (DPD) Asosiasi Pedagang Pasar Seluruh Indonesia (APPSI) Kabupaten Banyuasin', '2026-09-03 14:48:56', '2026-09-03 14:48:56'),
('2', 'singkatan', 'DPD APPSI KABUPATEN BANYUASIN', '2026-09-03 14:48:56', '2026-09-03 14:48:56'),
('3', 'nama_ketua', 'H. Gusra Yetri, SH', '2026-09-03 14:48:56', '2026-09-03 14:48:56'),
('4', 'jabatan_ketua', 'Ketua DPD APPSI Kabupaten Banyuasin', '2026-09-03 14:48:56', '2026-09-03 14:48:56'),
('5', 'nama_sekretaris', 'M. Rian Pratama, S.E.', '2026-09-03 14:48:56', '2026-09-03 14:48:56'),
('6', 'jabatan_sekretaris', 'Sekretaris DPD APPSI Kabupaten Banyuasin', '2026-09-03 14:48:56', '2026-09-03 14:48:56'),
('7', 'nama_bendahara', 'Hj. Siti Aminah', '2026-09-03 14:48:56', '2026-09-03 14:48:56'),
('8', 'alamat', 'Jalan Merdeka, Depan Pasar Baru Kelurahan Pangkalan Balai - Kecamatan Banyuasin III, Kabupaten Banyuasin, Sumatera Selatan', '2026-09-03 14:48:56', '2026-09-03 14:48:56'),
('9', 'telepon', '0811 618 808', '2026-09-03 14:48:56', '2026-09-03 14:48:56'),
('10', 'whatsapp', '62811618808', '2026-09-03 14:48:56', '2026-09-03 14:48:56'),
('11', 'email', 'appsi.banyuasin@gmail.com', '2026-09-03 14:48:56', '2026-09-03 14:48:56'),
('12', 'website', 'https://appsiba.or.id', '2026-09-03 14:48:56', '2026-09-03 14:48:56'),
('13', 'periode', '2024 - 2029', '2026-09-03 14:48:56', '2026-09-03 14:48:56'),
('14', 'visi', 'Mewujudkan Pasar Tradisional yang Kuat, Mandiri, dan Berdaya Saing untuk Kesejahteraan Pedagang dan Masyarakat Indonesia.', '2026-09-03 14:48:56', '2026-09-03 14:48:56'),
('15', 'misi', '1. Komunitas Daerah: Terhubung dengan pedagang pasar di seluruh Kabupaten Banyuasin dan jejaring nasional.\n2. Advokasi & Perlindungan: Memperjuangkan hak dan kepentingan pedagang pasar tradisional.\n3. Penguatan Kapasitas: Program, pelatihan digitalisasi, dan informasi untuk kemajuan usaha bersama.\n4. Kemitraan: Sinergi dengan instansi pemerintah, BUMD, dan perbankan demi permodalan dan fasilitas pasar yang higienis.', '2026-09-03 14:48:56', '2026-09-03 14:48:56'),
('16', 'sambutan_ketua', 'Bergabung dan jadilah bagian dari Asosiasi Pedagang Pasar Seluruh Indonesia sekarang! Bersama membangun pasar tradisional yang kuat, mandiri, dan berdaya saing untuk kesejahteraan pedagang dan masyarakat Banyuasin.', '2026-09-03 14:48:56', '2026-09-03 14:48:56'),
('17', 'tentang_organisasi', 'Asosiasi Pedagang Pasar Seluruh Indonesia (APPSI) adalah wadah resmi yang menghimpun, mewakili, dan memperjuangkan kepentingan pedagang pasar tradisional di seluruh Indonesia. Kami berkomitmen untuk membangun pasar tradisional yang kuat, mandiri, dan berdaya saing melalui kolaborasi, advokasi, dan pengembangan kapasitas para pedagang.', '2026-09-03 14:48:56', '2026-09-03 14:48:56');


-- --------------------------------------------------------
-- Struktur Tabel `migrations`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data untuk tabel `migrations`
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
('1', '0001_01_01_000000_create_users_table', '1'),
('2', '0001_01_01_000001_create_cache_table', '1'),
('3', '0001_01_01_000002_create_jobs_table', '1'),
('4', '2026_09_03_100000_create_appsiba_tables', '1');

COMMIT;
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;