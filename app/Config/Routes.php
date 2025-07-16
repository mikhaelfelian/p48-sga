<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(true);

# Default route form login
$routes->get('/', 'Login::index');
$routes->get('/index.php', 'Login::index');

# Testing Route
$routes->get('/', 'Login::index');
$routes->get('/Home/tes', 'Home::tes');

# Modul Login
$routes->post('login/cek_login.php', 'Login::cek_login');
$routes->get('/logout.php', 'Login::logout');
$routes->get('/dashboard.php', 'Home::index');


# Publik Modul
# Modul yang di akses oleh berbagai controller
$routes->group('', ['filter' => 'auth'], function($routes) {
    # Public JSON endpoints
    $routes->get('json_supplier.php', 'Publik::json_supplier');
    $routes->get('json_pelanggan.php', 'Publik::json_pelanggan');
    $routes->get('json_item.php', 'Publik::json_item');
    $routes->get('json_po.php', 'Publik::json_po');
    $routes->get('json_rab.php', 'Publik::json_rab');
    $routes->get('json_penj.php', 'Publik::json_penjualan');
});

#==========================================================================================
# --- PENGATURAN ---
# Profile User
$routes->group('profile', ['filter' => 'auth'], function($routes) {
    $routes->get('(:num)', 'Profile::index/$1');
    $routes->post('profile_set_update.php', 'Profile::profile_set_update');
    $routes->post('simpan_data_kel.php', 'Profile::simpan_data_kel');
    $routes->get('hapus_foto/(:num)', 'Profile::hapus_foto/$1');
    $routes->get('sdm/data_keluarga', 'Profile::data_keluarga');
    $routes->get('sdm/data_keluarga_edit/(:num)', 'Profile::data_keluarga_edit/$1');
    $routes->get('sdm/data_keluarga_hapus/(:num)', 'Profile::data_keluarga_hapus/$1');
    $routes->get('sdm/data_pendidikan', 'Profile::data_pendidikan');
    $routes->get('sdm/data_pendidikan/(:num)', 'Profile::data_pendidikan/$1');
    $routes->get('sdm/data_pendidikan_edit/(:num)', 'Profile::data_pendidikan_edit/$1');
    $routes->post('sdm/data_pendidikan_simpan/(:num)', 'Profile::data_pendidikan_simpan/$1');
    $routes->post('sdm/data_pendidikan_simpan', 'Profile::data_pendidikan_simpan');
    $routes->get('sdm/data_pendidikan_hapus/(:num)', 'Profile::data_pendidikan_hapus/$1');
    
    // Employee employment data routes
    $routes->get('sdm/data_pegawai', 'Profile::data_pegawai');
    $routes->get('sdm/data_pegawai/(:num)', 'Profile::data_pegawai/$1');
    $routes->post('sdm/data_pegawai_simpan.php', 'Profile::data_pegawai_simpan');
    $routes->get('sdm/data_pegawai_hapus/(:num)', 'Profile::data_pegawai_hapus/$1');
    
    // Employee leave/time-off data routes
    $routes->get('sdm/data_cuti', 'Profile::data_cuti');
    $routes->get('sdm/data_cuti/(:num)', 'Profile::data_cuti/$1');
    $routes->post('sdm/data_cuti_simpan.php', 'Profile::data_cuti_simpan');
    $routes->get('sdm/data_cuti_hapus/(:num)', 'Profile::data_cuti_hapus/$1');
    $routes->get('sdm/data_cuti_edit/(:num)', 'Profile::data_cuti_edit/$1');
});

# Pengaturan
$routes->group('pengaturan', ['filter' => 'auth'], function($routes) {
    # General Settings
    $routes->get('pengaturan.php', 'Pengaturan::pengaturan');
    $routes->post('pengaturan_set_update.php', 'Pengaturan::pengaturan_set_update');
    $routes->post('profile/profile_set_update.php', 'Pengaturan::profile_set_update');

    # Company Data
    $routes->get('perusahaan_list.php', 'Pengaturan::perusahaan_list');
    $routes->get('perusahaan_tambah.php', 'Pengaturan::perusahaan_tambah');
    $routes->post('perusahaan_set_simpan.php', 'Pengaturan::perusahaan_set_simpan');
    $routes->post('perusahaan_set_update.php', 'Pengaturan::perusahaan_set_update');
    $routes->post('perusahaan_set_cari.php', 'Pengaturan::perusahaan_set_cari');
    $routes->get('perusahaan_set_hapus.php', 'Pengaturan::perusahaan_set_hapus');
});


# Routing ke manajemen
$routes->group('manajemen', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Manajemen::index');
    $routes->get('index.php', 'Manajemen::index');
});

#==========================================================================================
# --- MASTER ---
$routes->group('master', ['filter' => 'auth'], function($routes) {
    # Master Kategori
    $routes->get('data_kategori.php', 'Master::data_kategori_list');
    $routes->get('data_kategori_tambah.php', 'Master::data_kategori_tambah');
    $routes->get('data_kategori_hapus.php', 'Master::data_kategori_hapus');
    $routes->post('set_kategori_simpan.php', 'Master::set_kategori_simpan');
    $routes->post('set_kategori_update.php', 'Master::set_kategori_update');
    $routes->post('set_kategori_cari.php', 'Master::set_kategori_cari');
    $routes->get('xls_kategori.php', 'Master::xls_kategori');
    $routes->get('data_kategori_import.php', 'Master::data_kategori_import');
    $routes->post('set_kategori_upload.php', 'Master::set_kategori_upload');

    # Master Merk
    $routes->get('data_merk.php', 'Master::data_merk_list');
    $routes->get('data_merk_tambah.php', 'Master::data_merk_tambah');
    $routes->get('data_merk_hapus.php', 'Master::data_merk_hapus');
    $routes->post('set_merk_simpan.php', 'Master::set_merk_simpan');
    $routes->post('set_merk_update.php', 'Master::set_merk_update');
    $routes->post('set_merk_cari.php', 'Master::set_merk_cari');
    $routes->get('xls_merk.php', 'Master::xls_merk');
    $routes->get('data_merk_import.php', 'Master::data_merk_import');
    $routes->post('set_merk_upload.php', 'Master::set_merk_upload');

    # Master Satuan
    $routes->get('data_satuan.php', 'Master::data_satuan_list');
    $routes->get('data_satuan_tambah.php', 'Master::data_satuan_tambah');
    $routes->post('set_satuan_simpan.php', 'Master::set_satuan_simpan');
    $routes->post('set_satuan_update.php', 'Master::set_satuan_update');
    $routes->get('set_satuan_hapus.php', 'Master::set_satuan_hapus');
    $routes->post('set_satuan_cari.php', 'Master::set_satuan_cari');

    # Master Item
    $routes->get('data_item.php', 'Master::data_item_list');
    $routes->get('data_item_tambah.php', 'Master::data_item_tambah');
    $routes->get('data_item_import.php', 'Master::data_item_import');
    $routes->get('xls_item.php', 'Master::xls_item');
    $routes->post('set_item_simpan.php', 'Master::set_item_simpan');
    $routes->post('set_item_update.php', 'Master::set_item_update');
    $routes->post('set_item_upload.php', 'Master::set_item_upload');
    $routes->get('set_item_hapus.php', 'Master::set_item_hapus');
    $routes->post('set_item_cari.php', 'Master::set_item_cari');

    # Master Tipe Dokumen
    $routes->get('data_berkas.php', 'Master::data_berkas');
    $routes->get('data_berkas_tambah.php', 'Master::data_berkas_tambah');
    $routes->get('set_berkas_hapus.php', 'Master::set_berkas_hapus');
    $routes->post('set_berkas_simpan.php', 'Master::set_berkas_simpan');

    # Master Pelanggan
    $routes->get('data_pelanggan.php', 'Master::data_pelanggan_list');
    $routes->get('data_pelanggan_tambah.php', 'Master::data_pelanggan_tambah');
    $routes->post('set_pelanggan_simpan.php', 'Master::set_pelanggan_simpan');
    $routes->post('set_pelanggan_cp_simpan.php', 'Master::set_pelanggan_simpan_cp');
    $routes->post('set_pelanggan_update.php', 'Master::set_pelanggan_update');
    $routes->get('set_pelanggan_hapus.php', 'Master::set_pelanggan_hapus');
    $routes->get('set_pelanggan_hapus_cp.php', 'Master::set_pelanggan_hapus_cp');
    $routes->post('set_pelanggan_cari.php', 'Master::set_pelanggan_cari');
    $routes->get('xls_pelanggan.php', 'Master::xls_pelanggan');
    $routes->get('data_pelanggan_import.php', 'Master::data_pelanggan_import');
    $routes->post('set_pelanggan_upload.php', 'Master::set_pelanggan_upload');

    # Master Supplier
    $routes->get('data_supplier.php', 'Master::data_supplier_list');
    $routes->get('data_supplier_tambah.php', 'Master::data_supplier_tambah');
    $routes->post('set_supplier_simpan.php', 'Master::set_supplier_simpan');
    $routes->post('set_supplier_update.php', 'Master::set_supplier_update');
    $routes->get('set_supplier_hapus.php', 'Master::set_supplier_hapus');
    $routes->post('set_supplier_cari.php', 'Master::set_supplier_cari');
    $routes->get('xls_supplier.php', 'Master::xls_supplier');
    $routes->get('data_supplier_import.php', 'Master::data_supplier_import');
    $routes->post('set_supplier_upload.php', 'Master::set_supplier_upload');

    # Master Karyawan
    $routes->get('karyawan_list.php', 'Master::karyawan_list');
    $routes->get('karyawan_tambah.php', 'Master::karyawan_tambah');
    $routes->post('karyawan_set_simpan.php', 'Master::karyawan_set_simpan');
    $routes->post('karyawan_set_update.php', 'Master::karyawan_set_update');
    $routes->get('karyawan_set_hapus.php', 'Master::karyawan_set_hapus');
    $routes->post('karyawan_set_cari.php', 'Master::karyawan_set_cari');
});


#==========================================================================================
# --- TRANSAKSI ---
$routes->group('transaksi', ['filter' => 'auth'], function($routes) {
    $routes->get('index.php', 'Transaksi::index');
    $routes->get('json_pelanggan.php', 'Transaksi::json_pelanggan');
    $routes->get('json_item.php', 'Transaksi::json_item');
    $routes->get('json_po.php', 'Transaksi::json_po');

    # --- TRANSAKSI PESANAN ---
    $routes->get('pesanan/data_pesanan.php', 'Transaksi::data_pesanan');
    $routes->get('pesanan/data_pesanan_tambah.php', 'Transaksi::data_pesanan_tambah');
    $routes->get('pesanan/data_pesanan_jawab.php', 'Transaksi::data_pesanan_jawab');
    $routes->post('pesanan/set_trans_simpan.php', 'Transaksi::set_pesanan_simpan');
    $routes->post('pesanan/set_trans_proses.php', 'Transaksi::set_pesanan_proses');
    $routes->post('pesanan/cart_simpan.php', 'Transaksi::cart_pesanan_simpan');
    $routes->get('pesanan/cart_hapus.php', 'Transaksi::cart_pesanan_hapus');

    # --- TRANSAKSI RAB ---
    $routes->get('rab/data_rab.php', 'Transaksi::data_rab');
    $routes->get('rab/data_rab_tambah.php', 'Transaksi::data_rab_tambah');
    $routes->get('rab/data_rab_det.php', 'Transaksi::data_rab_detail');
    $routes->get('rab/data_rab_aksi.php', 'Transaksi::data_rab_aksi');
    $routes->get('rab/data_rab_import.php', 'Transaksi::data_rab_import');
    $routes->post('rab/set_trans_simpan.php', 'Transaksi::set_rab_simpan');
    $routes->post('rab/set_trans_update.php', 'Transaksi::set_rab_update');
    $routes->post('rab/set_trans_po.php', 'Transaksi::set_rab_simpan_po');
    $routes->post('rab/set_trans_proses.php', 'Transaksi::set_rab_proses');
    $routes->post('rab/set_trans_import.php', 'Transaksi::set_rab_upload');
    $routes->post('rab/set_cari.php', 'Transaksi::set_rab_cari');
    $routes->post('rab/cart_simpan.php', 'Transaksi::cart_rab_simpan');
    $routes->post('rab/cart_simpan_po.php', 'Transaksi::cart_rab_simpan_po');
    $routes->get('rab/cart_hapus.php', 'Transaksi::cart_rab_hapus');
    $routes->get('rab/cart_hapus_po.php', 'Transaksi::cart_rab_hapus_po');
    $routes->get('rab/hapus.php', 'Transaksi::set_rab_hapus');
    $routes->get('rab/hapus_po.php', 'Transaksi::set_rab_hapus_po');
    $routes->get('rab/pdf_rab.php', 'Transaksi::pdf_rab');
    $routes->get('rab/pdf_rab_pen.php', 'Transaksi::pdf_rab_pen');
    $routes->get('rab/xls_rab_import.php', 'Transaksi::xls_rab_import');

    # --- TRANSAKSI PENJUALAN ---
    $routes->get('data_penjualan.php', 'Transaksi::data_penjualan');
    $routes->get('data_penjualan_tambah.php', 'Transaksi::data_penjualan_tambah');
    $routes->get('data_penjualan_aksi.php', 'Transaksi::data_penjualan_aksi');
    $routes->post('set_trans_update.php', 'Transaksi::set_penjualan_update');
    $routes->post('set_trans_simpan.php', 'Transaksi::set_penjualan_simpan');
    $routes->post('set_trans_proses.php', 'Transaksi::set_penjualan_proses');
    $routes->post('set_trans_bayar.php', 'Transaksi::set_penjualan_bayar');
    $routes->post('set_trans_cari.php', 'Transaksi::set_penjualan_cari');
    $routes->post('set_trans_po.php', 'Transaksi::set_penjualan_simpan_po');
    $routes->post('cart_simpan.php', 'Transaksi::cart_penjualan_simpan');
    $routes->post('cart_simpan_po.php', 'Transaksi::cart_penjualan_simpan_po');
    $routes->post('cart_simpan_do.php', 'Transaksi::cart_penjualan_simpan_do');
    $routes->post('cart_upload.php', 'Transaksi::cart_penjualan_upload');
    $routes->get('cart_hapus.php', 'Transaksi::cart_penjualan_hapus');
    $routes->get('cart_hapus_file.php', 'Transaksi::cart_penjualan_hapus_file');
    $routes->get('hapus_do.php', 'Gudang::set_pengiriman_hapus');
    $routes->get('pdf_penj_inv.php', 'Transaksi::pdf_penjualan_inv');
    $routes->get('pdf_penj_kwi.php', 'Transaksi::pdf_penjualan_kwi');

    # --- TRANSAKSI PEMBAYARAN ---
    $routes->get('data_pembayaran.php', 'Transaksi::data_pembayaran');
    $routes->get('data_pembayaran_tambah.php', 'Transaksi::data_pembayaran_tambah');
});

#==========================================================================================
# --- PEMBELIAN ---
$routes->group('pembelian', ['filter' => 'auth'], function($routes) {
    $routes->get('index.php', 'Pembelian::index');
    $routes->get('json_supplier.php', 'Pembelian::json_supplier');
    $routes->get('json_item.php', 'Transaksi::json_item');
    $routes->get('json_rab.php', 'Pembelian::json_rab');

    # --- PEMBELIAN - PURCHASE ORDER ---
    $routes->get('pesanan/data_pesanan.php', 'Pembelian::data_pesanan');
    $routes->get('pesanan/data_pesanan_tambah.php', 'Pembelian::data_pesanan_tambah');
    $routes->get('pesanan/data_pesanan_det.php', 'Pembelian::data_pesanan_detail');
    $routes->post('pesanan/set_trans_simpan.php', 'Pembelian::set_pesanan_simpan');
    $routes->post('pesanan/set_trans_proses.php', 'Pembelian::set_pesanan_proses');
    $routes->post('pesanan/set_cari.php', 'Pembelian::set_pesanan_cari');
    $routes->post('pesanan/cart_simpan.php', 'Pembelian::cart_pesanan_simpan');
    $routes->get('pesanan/cart_hapus.php', 'Pembelian::cart_pesanan_hapus');
    $routes->get('pesanan/hapus.php', 'Pembelian::set_pesanan_hapus');
    $routes->get('pesanan/pdf_pesanan.php', 'Pembelian::pdf_pesanan');

    # --- PEMBELIAN - FAKTUR BELI ---
    $routes->get('faktur/data_pembelian.php', 'Pembelian::data_pembelian');
    $routes->get('faktur/data_pembelian_tambah.php', 'Pembelian::data_pembelian_tambah');
    $routes->get('faktur/data_pembelian_det.php', 'Pembelian::data_pembelian_detail');
    $routes->post('faktur/set_trans_simpan.php', 'Pembelian::set_pembelian_simpan');
    $routes->post('faktur/set_trans_proses.php', 'Pembelian::set_pembelian_proses');
    $routes->post('faktur/set_trans_bayar.php', 'Pembelian::set_pembelian_bayar');
    $routes->post('faktur/cart_simpan.php', 'Pembelian::cart_pembelian_simpan');
    $routes->get('faktur/cart_hapus.php', 'Pembelian::cart_pembelian_hapus');

    # --- PEMBELIAN - PEMBAYARAN ---
    $routes->get('faktur/data_pembayaran.php', 'Pembelian::data_pembayaran');
    $routes->get('faktur/data_pembayaran_tambah.php', 'Pembelian::data_pembayaran_tambah');
});

#==========================================================================================
# --- GUDANG ---
$routes->group('gudang', ['filter' => 'auth'], function($routes) {
    $routes->get('index.php', 'Gudang::index');
    
    # --- GUDANG - PENERIMAAN ---
    $routes->get('penerimaan/index.php', 'Gudang::index');
    $routes->get('penerimaan/data_beli.php', 'Gudang::data_beli');
    $routes->get('penerimaan/data_beli_terima.php', 'Gudang::data_beli_terima');
    $routes->get('penerimaan/data_beli_terima_item.php', 'Gudang::data_beli_terima_item');
    $routes->get('penerimaan/cart_hapus.php', 'Gudang::cart_beli_hapus');
    $routes->get('penerimaan/set_hapus_item_sn.php', 'Gudang::set_beli_hapus_sn');
    $routes->post('penerimaan/set_terima_item.php', 'Gudang::set_beli_terima_simpan');
    $routes->post('penerimaan/set_terima_item_sn.php', 'Gudang::set_beli_terima_simpan_sn');
    $routes->post('penerimaan/set_terima_proses.php', 'Gudang::set_beli_terima_proses');
    
    # --- GUDANG - MUTASI ---
    $routes->get('mutasi/data_mutasi.php', 'Gudang::data_mutasi');
    $routes->get('mutasi/data_mutasi_tambah.php', 'Gudang::data_mutasi_tambah');
    $routes->get('mutasi/data_mutasi_det.php', 'Gudang::data_mutasi_det');
    $routes->post('mutasi/set_trans_simpan.php', 'Gudang::set_mutasi_simpan');
    $routes->post('mutasi/set_trans_proses.php', 'Gudang::set_mutasi_proses');
    $routes->post('mutasi/cart_simpan.php', 'Gudang::cart_mutasi_simpan');
    $routes->post('mutasi/cart_hapus.php', 'Gudang::cart_mutasi_hapus');
    $routes->post('mutasi/set_mutasi_cari.php', 'Gudang::set_mutasi_cari');
    $routes->get('mutasi/pdf_mutasi_do.php', 'Gudang::pdf_mutasi_do');
    
    # --- GUDANG - PENGIRIMAN ---
    $routes->get('pengiriman/data_kirim.php', 'Gudang::data_pengiriman');
    $routes->get('pengiriman/data_kirim_tambah.php', 'Gudang::data_pengiriman_tambah');
    $routes->get('pengiriman/data_kirim_det.php', 'Gudang::data_pengiriman_det');
    $routes->post('pengiriman/set_trans_simpan.php', 'Gudang::set_pengiriman_simpan');
    $routes->post('pengiriman/set_trans_proses.php', 'Gudang::set_pengiriman_proses');
    $routes->post('pengiriman/cart_simpan.php', 'Gudang::cart_pengiriman_simpan');
    $routes->post('pengiriman/cart_hapus.php', 'Gudang::cart_mutasi_hapus');
    
    # --- GUDANG - STOK ---
    $routes->get('stok/data_sn.php', 'Gudang::data_sn');
    $routes->post('stok/set_sn_cari.php', 'Gudang::set_sn_cari');
    $routes->get('stok/data_item.php', 'Gudang::data_item');
    $routes->get('stok/data_item_det.php', 'Gudang::data_item_stok');
    $routes->post('stok/set_item_simpan.php', 'Gudang::set_item_simpan');
});

# --- SDM - KARYAWAN ---
# SDM Module
$routes->group('sdm', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Sdm::index');
    $routes->get('data_karyawan.php', 'Sdm::data_karyawan');
    $routes->get('cuti/data_cuti.php', 'Sdm::data_cuti');
});



#==========================================================================================
# --- LAPORAN ---
# Laporan Module
$routes->group('laporan', ['filter' => 'auth'], function($routes) {
    $routes->get('index.php', 'Laporan::index');
    $routes->get('omset/data_rab.php', 'Laporan::data_rab');
    $routes->get('omset/data_penjualan.php', 'Laporan::data_penjualan');
    $routes->get('omset/data_pembelian.php', 'Laporan::data_pembelian');
    $routes->get('finance/data_modal.php', 'Laporan::data_modal');
    $routes->get('finance/data_untung_rugi.php', 'Laporan::data_untung_rugi');
    $routes->get('gudang/data_stock.php', 'Laporan::data_stock');
    $routes->get('resume/data_karyawan.php', 'Laporan::data_karyawan');
    $routes->get('resume/data_supplier.php', 'Laporan::data_supplier');
});

$routes->get('pengaturan/hapus_img.php', 'Pengaturan::hapus_img');

// Add route for the sample page
$routes->get('sample', 'SampleController::index');