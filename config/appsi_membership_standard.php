<?php

/**
 * Standar Konfigurasi Formulir Pendaftaran Anggota DPP APPSI Pusat
 *
 * Digunakan sebagai acuan skema data, validasi, dan standarisasi komoditas nasional
 * untuk DPD APPSI Kabupaten Banyuasin (Roadmap Pengembangan Mendatang).
 *
 * Referensi: https://keanggotaan.appsi.id
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Tahapan Formulir Pendaftaran (5 Tahap Wizard)
    |--------------------------------------------------------------------------
    */
    'steps' => [
        1 => [
            'key' => 'identitas_anggota',
            'title' => 'Identitas Anggota',
            'icon' => 'fa-users',
            'description' => 'Data pribadi, nomor identitas kependudukan, dan alamat tempat tinggal.',
        ],
        2 => [
            'key' => 'data_tempat_usaha',
            'title' => 'Data Tempat Usaha',
            'icon' => 'fa-briefcase',
            'description' => 'Karakteristik kios/lapak, pasar binaan, dan 22 kategori komoditas dagang.',
        ],
        3 => [
            'key' => 'data_modal_asset',
            'title' => 'Data Modal/Asset',
            'icon' => 'fa-money',
            'description' => 'Kesehatan finansial, omset harian, laba harian, dan kewajiban angsuran/hutang.',
        ],
        4 => [
            'key' => 'kebutuhan_modal_usaha',
            'title' => 'Kebutuhan Modal Usaha',
            'icon' => 'fa-credit-card',
            'description' => 'Pemetaan kebutuhan modal kerja dan fasilitasi pembiayaan perbankan / KUR.',
        ],
        5 => [
            'key' => 'lampiran',
            'title' => 'Lampiran Dokumen',
            'icon' => 'fa-file-image-o',
            'description' => 'Unggah pas foto, KTP, KK, CV usaha, dan SIPTU/surat keterangan usaha pasar.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Pilihan Jenis Identitas
    |--------------------------------------------------------------------------
    */
    'identity_types' => [
        'KTP' => 'Kartu Tanda Penduduk (KTP)',
        'SIM' => 'Surat Izin Mengemudi (SIM)',
        'PASSPORT' => 'Paspor RI',
    ],

    /*
    |--------------------------------------------------------------------------
    | Pilihan Status Pernikahan
    |--------------------------------------------------------------------------
    */
    'marital_statuses' => [
        'Nikah' => 'Menikah',
        'Belum Nikah' => 'Belum Menikah',
        'Duda/Janda' => 'Duda / Janda',
    ],

    /*
    |--------------------------------------------------------------------------
    | Pilihan Jenjang Pendidikan Terakhir
    |--------------------------------------------------------------------------
    */
    'education_levels' => [
        1 => 'Sekolah Dasar (SD)',
        2 => 'Sekolah Menengah Pertama (SMP)',
        3 => 'Sekolah Menengah Atas / Kejuruan (SMA/SMK)',
        4 => 'Akademi / Diploma / Sarjana',
    ],

    /*
    |--------------------------------------------------------------------------
    | Pilihan Jenis Tempat Usaha di Pasar
    |--------------------------------------------------------------------------
    */
    'business_place_types' => [
        1 => 'Ruko / Toko Pasar',
        2 => 'Kios',
        3 => 'Los Pasar',
        4 => 'Lapak / Counter',
        5 => 'Pedagang Kaki Lima (PKL)',
    ],

    /*
    |--------------------------------------------------------------------------
    | Pilihan Golongan Usaha
    |--------------------------------------------------------------------------
    */
    'business_categories' => [
        1 => 'Distributor',
        2 => 'Agen',
        3 => 'Grosir',
        4 => 'Eceran',
    ],

    /*
    |--------------------------------------------------------------------------
    | Pilihan Status Kepemilikan Tempat Usaha
    |--------------------------------------------------------------------------
    */
    'place_ownership_statuses' => [
        'Milik Sendiri' => 'Milik Sendiri (SHM / Hak Milik)',
        'Sewa' => 'Sewa (Bulanan / Tahunan)',
        'Kerjasama' => 'Bagi Hasil / Kerjasama',
        'Lain-Lain' => 'Lain-lain / Hak Guna Usaha',
    ],

    /*
    |--------------------------------------------------------------------------
    | Daftar 22 Standar Komoditas Dagangan APPSI Nasional
    |--------------------------------------------------------------------------
    */
    'commodities_22' => [
        1 => 'Logam Mulia',
        2 => 'Jam',
        3 => 'Textil / Pakaian',
        4 => 'Sepatu / Tas',
        5 => 'Aksesoris',
        6 => 'ATK / Buku',
        7 => 'Peralatan Rumah Tangga',
        8 => 'Elektronik',
        9 => 'Handphone',
        10 => 'Sparepart Mobil',
        11 => 'Sparepart Motor',
        12 => 'Sparepart Elektronik',
        13 => 'Sembako',
        14 => 'Kelontong',
        15 => 'Buah-Buahan',
        16 => 'Sayur Mayur',
        17 => 'Bumbu Dapur',
        18 => 'Daging Sapi',
        19 => 'Daging Kambing',
        20 => 'Ayam',
        21 => 'Ikan',
        22 => 'Makanan / Minuman',
    ],

    /*
    |--------------------------------------------------------------------------
    | Pilihan Periode Angsuran Kewajiban Finansial
    |--------------------------------------------------------------------------
    */
    'installment_types' => [
        'Harian' => 'Harian',
        'Mingguan' => 'Mingguan',
        'Bulanan' => 'Bulanan',
    ],

    /*
    |--------------------------------------------------------------------------
    | Pilihan Tier / Rentang Bantuan Permodalan Usaha (KUR)
    |--------------------------------------------------------------------------
    */
    'capital_need_tiers' => [
        1 => [
            'label' => 'Rp 0 - Rp 1.000.000',
            'category' => 'Ultra Mikro',
        ],
        2 => [
            'label' => 'Rp 1.000.000 - Rp 5.000.000',
            'category' => 'KUR Super Mikro',
        ],
        3 => [
            'label' => 'Rp 5.000.000 - Rp 20.000.000',
            'category' => 'KUR Mikro',
        ],
        4 => [
            'label' => 'Rp 20.000.000 - Rp 50.000.000',
            'category' => 'KUR Ritel Kecil',
        ],
        5 => [
            'label' => 'Rp 50.000.000 - Rp 100.000.000',
            'category' => 'KUR Menengah',
        ],
        6 => [
            'label' => 'Rp 100.000.000 - Rp 200.000.000',
            'category' => 'Kredit Komersial / Grosir',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Ketentuan Upload Berkas Lampiran
    |--------------------------------------------------------------------------
    */
    'attachments' => [
        'foto_diri' => [
            'label' => 'Pas Foto Diri Pedagang',
            'allowed_mimes' => ['jpeg', 'jpg', 'png', 'webp'],
            'max_size_kb' => 2048,
            'required' => true,
        ],
        'foto_identitas' => [
            'label' => 'Foto KTP / SIM / Paspor',
            'allowed_mimes' => ['jpeg', 'jpg', 'png', 'pdf'],
            'max_size_kb' => 2048,
            'required' => true,
        ],
        'foto_kk' => [
            'label' => 'Foto Kartu Keluarga (KK)',
            'allowed_mimes' => ['jpeg', 'jpg', 'png', 'pdf'],
            'max_size_kb' => 2048,
            'required' => false,
        ],
        'foto_cv' => [
            'label' => 'Ringkasan Profil / CV Usaha',
            'allowed_mimes' => ['jpeg', 'jpg', 'png', 'pdf', 'docx'],
            'max_size_kb' => 2048,
            'required' => false,
        ],
        'foto_siptu' => [
            'label' => 'SIPTU / Surat Keterangan Usaha',
            'allowed_mimes' => ['jpeg', 'jpg', 'png', 'pdf'],
            'max_size_kb' => 2048,
            'required' => false,
        ],
    ],
];
