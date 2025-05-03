<?php

namespace App\Controllers;

/**
 * Description of Laporan
 *
 * @author mike
 */
class Laporan extends BaseController
{

    public function index()
    {
        if ($this->ionAuth->loggedIn()) {
            $ID = $this->ionAuth->user()->row();
            $IDGrup = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup = $this->ionAuth->groups()->result();

            $data = [
                'AksesGrup' => $AksesGrup,
                'Pengguna' => $ID,
                'PenggunaGrup' => $IDGrup,
                'Pengaturan' => $this->Setting,
                'ThemePath' => $this->ThemePath,
                'menu_atas' => $this->ThemePath . '/layout/menu_atas',
                'menu_kiri' => $this->ThemePath . '/manajemen/laporan/menu_kiri',
                'konten' => $this->ThemePath . '/manajemen/laporan/konten',
            ];

            return view($this->ThemePath . '/index', $data);
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }

    public function data_rab()
    {
        if ($this->ionAuth->loggedIn()) {
            $ID = $this->ionAuth->user()->row();
            $IDGrup = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup = $this->ionAuth->groups()->result();

            $kode = $this->input->getVar('filter_kode');
            $nama = $this->input->getVar('filter_nama');
            $tipe = $this->input->getVar('filter_tipe');
            $status = $this->input->getVar('status');
            $hlmn = $this->input->getVar('page');

            $Tipe = new \App\Models\mTipe();
            $vtrRab = new \App\Models\vtrRab();
            $Profile = new \App\Models\PengaturanProfile();
            $sql_profile = $Profile->asObject()
                ->where('status', '1')
                ->find();

            $sql_rab = $vtrRab->asObject()
                ->orderBy('id', 'DESC')
                ->like('no_rab', (!empty($kode) ? $kode : ''))
                ->like('p_nama', (!empty($nama) ? $nama : ''))
                ->like('id_tipe', (!empty($tipe) ? $tipe : ''), (!empty($tipe) ? 'none' : ''))
                ->like('status', (!empty($status) ? $status : ''), (!empty($status) ? 'none' : ''));

            $sql_tipe = $Tipe->asObject()
                ->where('status', '1')
                ->find(); //->like('kode', (!empty($kode) ? $kode : ''))->like('kategori', (!empty($kat) ? $kat : ''));

            $jml_limit = $this->Setting->jml_item;

            $data = [
                'SQLRab'        => $sql_rab->paginate($jml_limit),
                'SQLTipe'       => $sql_tipe,
                'SQLUsers'      => $this->ionAuth->users('sales')->result(),
                'SQLProfile'    => $sql_profile,
                'Pagination'    => $vtrRab->pager->links(),
                'Halaman'       => (isset($_GET['page']) ? ($_GET['page'] != '1' ? ($_GET['page'] * $jml_limit) + 1 : 1) : 1),
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath . '/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath . '/manajemen/laporan/menu_kiri',
                'konten'        => $this->ThemePath . '/manajemen/laporan/data_rab',
            ];

            return view($this->ThemePath . '/index', $data);
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }

    /**
     * Display sales data report
     * 
     * @author mike
     * @date 2024-03-13
     */
    public function data_penjualan()
    {
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();

            // Get filter parameters
            $kode       = $this->input->getVar('filter_kode');
            $nama       = $this->input->getVar('filter_nama');
            $sales      = $this->input->getVar('filter_sales');
            $status     = $this->input->getVar('status');
            $tgl_rentang = $this->input->getVar('filter_tgl_rentang');
            $hlmn       = $this->input->getVar('page');

            // Initialize models
            $trPenj = new \App\Models\trPenj();
            $trTotal = new \App\Models\trPenj();
            $trBiaya = new \App\Models\trPenj();
            $Profile = new \App\Models\PengaturanProfile();
            $sql_profile = $Profile->asObject()->where('status', '1')->find();

            // Build query with filters
            $sql_penj = $trPenj->asObject()
                ->select('tbl_trans_jual.*, tbl_m_pelanggan.nama as p_nama, tbl_m_pelanggan.alamat as p_alamat')
                ->join('tbl_m_pelanggan', 'tbl_m_pelanggan.id = tbl_trans_jual.id_pelanggan', 'left')
                ->orderBy('tbl_trans_jual.id', 'DESC');

            // Function to apply filters dynamically
            $applyFilters = function ($query) use ($kode, $nama, $sales, $status, $tgl_rentang) {
                if (!empty($kode)) {
                    $query->groupStart()
                        ->like('tbl_trans_jual.no_nota', $kode)
                        ->orLike('tbl_trans_jual.no_kontrak', $kode)
                        ->orLike('tbl_trans_jual.no_paket', $kode)
                        ->groupEnd();
                }

                if (!empty($nama)) {
                    $query->like('tbl_m_pelanggan.nama', $nama);
                }

                if (!empty($sales)) {
                    $query->where('tbl_trans_jual.id_sales', $sales);
                }

                if (!empty($status)) {
                    $query->where('tbl_trans_jual.status', $status);
                }

                // Handle date range filter
                if (!empty($tgl_rentang)) {
                    $dates = explode(' - ', $tgl_rentang);
                    if (count($dates) == 2) {
                        $start_date = tgl_indo_sys($dates[0]);
                        $end_date = tgl_indo_sys($dates[1]);
                        $query->where('tbl_trans_jual.tgl_simpan >=', $start_date)
                            ->where('tbl_trans_jual.tgl_simpan <=', $end_date);
                    }
                }
                return $query;
            };

            // Apply filters to the main query
            $sql_penj = $applyFilters($sql_penj);

            // Calculate total data with applied filters
            $total_data = $applyFilters($trTotal->asObject())
                ->select('COUNT(tbl_trans_jual.id) as total_data')
                ->first();

            // Calculate total biaya with applied filters
            $total_biaya = $applyFilters($trBiaya->asObject())
                ->select('SUM(tbl_trans_jual.jml_gtotal) as total_biaya')
                ->first();

            // Set pagination limit
            $jml_limit = $this->Setting->jml_item;

            $data = [
                'SQLPenjualan'  => $sql_penj->paginate($jml_limit),
                'SQLUsers'      => $this->ionAuth->users('sales')->result(),
                'SQLProfile'    => $sql_profile,
                'Pagination'    => $trPenj->pager->links('default', 'bootstrap_full'),
                'Halaman'       => (isset($_GET['page']) ? ($_GET['page'] != '1' ? ($_GET['page'] * $jml_limit) + 1 : 1) : 1),
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath . '/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath . '/manajemen/laporan/menu_kiri',
                'konten'        => $this->ThemePath . '/manajemen/laporan/data_penjualan',
                'ionAuth'       => $this->ionAuth,
                'total_data'    => $total_data->total_data ?? 0,
                'total_biaya'   => $total_biaya->total_biaya ?? 0,
            ];

            return view($this->ThemePath . '/index', $data);
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }

    /**
     * Display purchase data report
     * 
     * @author mike
     * @date 2024-03-13
     */
    public function data_pembelian()
    {
        if ($this->ionAuth->loggedIn()) {
            // Get user information
            $ID = $this->ionAuth->user()->row();
            $IDGrup = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup = $this->ionAuth->groups()->result();

            // Get filter parameters from request
            $kode = $this->input->getVar('filter_kode');
            $nama = $this->input->getVar('filter_nama');
            $supplier = $this->input->getVar('filter_supplier');
            $status = $this->input->getVar('status');
            $tgl_rentang = $this->input->getVar('filter_tgl_rentang');
            $hlmn = $this->input->getVar('page');

            $trPembelian = new \App\Models\trPembelian();
            $trTotal = new \App\Models\trPembelian();
            $trBiaya = new \App\Models\trPembelian();
            $Profile = new \App\Models\PengaturanProfile();
            $sql_profile = $Profile->asObject()
                ->where('status', '1')
                ->find();

            // Build query with proper joins and field selection
            $sql_pembelian = $trPembelian->asObject()
                ->select('tbl_trans_beli.*, tbl_m_supplier.nama as supplier, tbl_m_supplier.alamat')
                ->join('tbl_m_supplier', 'tbl_m_supplier.id = tbl_trans_beli.id_supplier', 'left')
                ->orderBy('tbl_trans_beli.id', 'DESC');


            // Function to apply filters dynamically
            $applyFilters = function ($query) use ($kode, $nama, $supplier, $status, $tgl_rentang) {
                if (!empty($kode)) {
                    $query->like('tbl_trans_beli.no_nota', $kode);
                }

                if (!empty($nama)) {
                    $query->like('tbl_m_supplier.nama', $nama);
                }

                if (!empty($supplier)) {
                    $query->where('tbl_trans_beli.id_supplier', $supplier);
                }

                if (!empty($status)) {
                    $query->where('tbl_trans_beli.status', $status);
                }

                // Handle date range filter
                if (!empty($tgl_rentang)) {
                    $dates = explode(' - ', $tgl_rentang);
                    if (count($dates) == 2) {
                        $start_date = tgl_indo_sys($dates[0]);
                        $end_date = tgl_indo_sys($dates[1]);
                        $query->where('tbl_trans_beli.tgl_simpan >=', $start_date)
                            ->where('tbl_trans_beli.tgl_simpan <=', $end_date);
                    }
                }
                return $query;
            };

            // Apply filters to the main query
            $sql_pembelian = $applyFilters($sql_pembelian);

            // Calculate total data with applied filters
            $total_data = $applyFilters($trTotal->asObject())
                ->select('COUNT(tbl_trans_beli.id) as total_data')
                ->first();

            // Calculate total biaya with applied filters
            $total_biaya = $applyFilters($trBiaya->asObject())
                ->select('SUM(tbl_trans_beli.jml_gtotal) as total_biaya')
                ->first();

            $jml_limit = $this->Setting->jml_item;

            $data = [
                'SQLPembelian'  => $sql_pembelian->paginate($jml_limit),
                'SQLSupplier'   => $this->ionAuth->users('supplier')->result(),
                'SQLProfile'    => $sql_profile,
                'Pagination'    => $trPembelian->pager->links('default', 'bootstrap_full'),
                'Halaman'       => (isset($_GET['page']) ? ($_GET['page'] != '1' ? ($_GET['page'] * $jml_limit) + 1 : 1) : 1),
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath . '/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath . '/manajemen/laporan/menu_kiri',
                'konten'        => $this->ThemePath . '/manajemen/laporan/data_pembelian',
                'ionAuth'       => $this->ionAuth,
                'total_data'    => $total_data->total_data ?? 0,
                'total_biaya'   => $total_biaya->total_biaya ?? 0,
            ];

            return view($this->ThemePath . '/index', $data);
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }

    /**
     * Display sales data modal
     * 
     * @author redha
     * @date 2025-05-03
     */
    public function data_modal()
    {
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();

            // Get filter parameters
            $kode       = $this->input->getVar('filter_kode');
            $nama       = $this->input->getVar('filter_nama');
            $sales      = $this->input->getVar('filter_sales');
            $status     = $this->input->getVar('status');
            $tgl_rentang = $this->input->getVar('filter_tgl_rentang');
            $hlmn       = $this->input->getVar('page');

            // Initialize models
            $trPenj = new \App\Models\trPenj();
            $trTotal = new \App\Models\trPenj();
            $trBiaya = new \App\Models\trPenj();
            $Profile = new \App\Models\PengaturanProfile();
            $sql_profile = $Profile->asObject()->where('status', '1')->find();

            // Build query with filters
            $sql_penj = $trPenj->asObject()
                ->select('tbl_trans_jual.*, tbl_m_pelanggan.nama as p_nama, tbl_m_pelanggan.alamat as p_alamat')
                ->join('tbl_m_pelanggan', 'tbl_m_pelanggan.id = tbl_trans_jual.id_pelanggan', 'left')
                ->orderBy('tbl_trans_jual.id', 'DESC');

            // Function to apply filters dynamically
            $applyFilters = function ($query) use ($kode, $nama, $sales, $status, $tgl_rentang) {
                if (!empty($kode)) {
                    $query->groupStart()
                        ->like('tbl_trans_jual.no_nota', $kode)
                        ->orLike('tbl_trans_jual.no_kontrak', $kode)
                        ->orLike('tbl_trans_jual.no_paket', $kode)
                        ->groupEnd();
                }

                if (!empty($nama)) {
                    $query->like('tbl_m_pelanggan.nama', $nama);
                }

                if (!empty($sales)) {
                    $query->where('tbl_trans_jual.id_sales', $sales);
                }

                if (!empty($status)) {
                    $query->where('tbl_trans_jual.status', $status);
                }

                // Handle date range filter
                if (!empty($tgl_rentang)) {
                    $dates = explode(' - ', $tgl_rentang);
                    if (count($dates) == 2) {
                        $start_date = tgl_indo_sys($dates[0]);
                        $end_date = tgl_indo_sys($dates[1]);
                        $query->where('tbl_trans_jual.tgl_simpan >=', $start_date)
                            ->where('tbl_trans_jual.tgl_simpan <=', $end_date);
                    }
                }
                return $query;
            };

            // Apply filters to the main query
            $sql_penj = $applyFilters($sql_penj);

            // Calculate total data with applied filters
            $total_data = $applyFilters($trTotal->asObject())
                ->select('COUNT(tbl_trans_jual.id) as total_data')
                ->first();

            // Calculate total biaya with applied filters
            $total_biaya = $applyFilters($trBiaya->asObject())
                ->select('SUM(tbl_trans_jual.jml_hpp) as total_biaya')
                ->first();

            // Set pagination limit
            $jml_limit = $this->Setting->jml_item;

            $data = [
                'SQLPenjualan'  => $sql_penj->paginate($jml_limit),
                'SQLUsers'      => $this->ionAuth->users('sales')->result(),
                'SQLProfile'    => $sql_profile,
                'Pagination'    => $trPenj->pager->links('default', 'bootstrap_full'),
                'Halaman'       => (isset($_GET['page']) ? ($_GET['page'] != '1' ? ($_GET['page'] * $jml_limit) + 1 : 1) : 1),
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath . '/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath . '/manajemen/laporan/menu_kiri',
                'konten'        => $this->ThemePath . '/manajemen/laporan/data_modal',
                'ionAuth'       => $this->ionAuth,
                'total_data'    => $total_data->total_data ?? 0,
                'total_biaya'   => $total_biaya->total_biaya ?? 0,
            ];

            return view($this->ThemePath . '/index', $data);
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }

    /**
     * Display sales data report
     * 
     * @author redha
     * @date 2025-05-03
     */
    public function data_untung_rugi()
    {
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();

            // Get filter parameters
            $kode       = $this->input->getVar('filter_kode');
            $nama       = $this->input->getVar('filter_nama');
            $sales      = $this->input->getVar('filter_sales');
            $status     = $this->input->getVar('status');
            $tgl_rentang = $this->input->getVar('filter_tgl_rentang');
            $profit_status = $this->input->getVar('filter_profit');
            $hlmn       = $this->input->getVar('page');

            // Initialize models
            $trPenj = new \App\Models\trPenj();
            $trTotal = new \App\Models\trPenj();
            $trUntung = new \App\Models\trPenj();
            $trRugi = new \App\Models\trPenj();
            $Profile = new \App\Models\PengaturanProfile();
            $sql_profile = $Profile->asObject()->where('status', '1')->find();

            // Build query with filters
            $sql_penj = $trPenj->asObject()
                ->select('tbl_trans_jual.*, tbl_m_pelanggan.nama as p_nama, tbl_m_pelanggan.alamat as p_alamat, 
                (CASE 
                    WHEN tbl_trans_jual.jml_profit >= 0 THEN "Untung" 
                    ELSE "Rugi" 
                END) AS profit_status')
                ->join('tbl_m_pelanggan', 'tbl_m_pelanggan.id = tbl_trans_jual.id_pelanggan', 'left')
                ->orderBy('tbl_trans_jual.id', 'DESC');

            // Function to apply filters dynamically
            $applyFilters = function ($query) use ($kode, $nama, $sales, $status, $profit_status, $tgl_rentang) {
                if (!empty($kode)) {
                    $query->groupStart()
                        ->like('tbl_trans_jual.no_nota', $kode)
                        ->orLike('tbl_trans_jual.no_kontrak', $kode)
                        ->orLike('tbl_trans_jual.no_paket', $kode)
                        ->groupEnd();
                }

                if (!empty($nama)) {
                    $query->like('tbl_m_pelanggan.nama', $nama);
                }

                if (!empty($sales)) {
                    $query->where('tbl_trans_jual.id_sales', $sales);
                }

                if (!empty($status)) {
                    $query->where('tbl_trans_jual.status', $status);
                }

                if (!empty($profit_status)) {
                    if ($profit_status == 'Untung') {
                        $query->where('tbl_trans_jual.jml_profit >=', 0);
                    } elseif ($profit_status == 'Rugi') {
                        $query->where('tbl_trans_jual.jml_profit <', 0);
                    }
                }

                // Handle date range filter
                if (!empty($tgl_rentang)) {
                    $dates = explode(' - ', $tgl_rentang);
                    if (count($dates) == 2) {
                        $start_date = tgl_indo_sys($dates[0]);
                        $end_date = tgl_indo_sys($dates[1]);
                        $query->where('tbl_trans_jual.tgl_simpan >=', $start_date)
                            ->where('tbl_trans_jual.tgl_simpan <=', $end_date);
                    }
                }
                return $query;
            };

            // Apply filters to the main query
            $sql_penj = $applyFilters($sql_penj);

            // Calculate total data with applied filters
            $total_data = $applyFilters($trTotal->asObject())
                ->select('COUNT(tbl_trans_jual.id) as total_data')
                ->first();

            // Calculate total biaya with applied filters
            $total_untung = $applyFilters($trUntung->asObject())
                ->select('SUM(tbl_trans_jual.jml_profit) as total_untung')
                ->where('tbl_trans_jual.jml_profit >=', 0)
                ->first();

            $total_rugi = $applyFilters($trRugi->asObject())
                ->select('SUM(tbl_trans_jual.jml_profit) as total_rugi')
                ->where('tbl_trans_jual.jml_profit <', 0)
                ->first();

            // Set pagination limit
            $jml_limit = $this->Setting->jml_item;

            $data = [
                'SQLPenjualan'  => $sql_penj->paginate($jml_limit),
                'SQLUsers'      => $this->ionAuth->users('sales')->result(),
                'SQLProfile'    => $sql_profile,
                'Pagination'    => $trPenj->pager->links('default', 'bootstrap_full'),
                'Halaman'       => (isset($_GET['page']) ? ($_GET['page'] != '1' ? ($_GET['page'] * $jml_limit) + 1 : 1) : 1),
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath . '/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath . '/manajemen/laporan/menu_kiri',
                'konten'        => $this->ThemePath . '/manajemen/laporan/data_untung_rugi',
                'ionAuth'       => $this->ionAuth,
                'total_data'    => $total_data->total_data ?? 0,
                'total_untung'   => $total_untung->total_untung ?? 0,
                'total_rugi'   => $total_rugi->total_rugi ?? 0,
            ];

            return view($this->ThemePath . '/index', $data);
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }

    public function data_karyawan()
    {
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();

            $nama       = $this->input->getVar('filter_nama');
            $kode       = $this->input->getVar('filter_kode');
            $hlmn       = $this->input->getVar('page');

            $Kary       = new \App\Models\mKaryawan();
            $sql_kary   = $Kary->asObject()->orderBy('id', 'DESC');
            // Apply filters if they exist
            if (!empty($kode)) {
                $sql_kary->like('kode', $kode);
            }

            if (!empty($nama)) {
                $sql_kary->like('nama', $nama);
            }

            $jml_limit  = $this->Setting->jml_item;

            $data  = [
                'SQLKary'       => $sql_kary->paginate($jml_limit),
                'Pagination'    => $sql_kary->pager->links('default', 'bootstrap_full'),
                'Halaman'       => (isset($_GET['page']) ? ($_GET['page'] != '1' ? ($_GET['page'] * $jml_limit) + 1 : 1) : 1),
                'MenuAktif'     => 'active',
                'MenuOpen'      => 'menu-open',
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath . '/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath . '/manajemen/laporan/menu_kiri',
                'konten'        => $this->ThemePath . '/manajemen/laporan/data_karyawan',
            ];

            return view($this->ThemePath . '/index', $data);
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }

    public function data_supplier(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();

            $nama       = $this->input->getVar('filter_nama');
            $kode       = $this->input->getVar('filter_kode');
            $hlmn       = $this->input->getVar('page');

            $Supp       = new \App\Models\mSupplier();
            $sql_supp   = $Supp->asObject()->orderBy('id', 'DESC');
            // Apply filters if they exist
            if (!empty($kode)) {
                $sql_supp->like('kode', $kode);
            }

            if (!empty($nama)) {
                $sql_supp->like('nama', $nama);
            }

            $jml_limit  = $this->Setting->jml_item;
                                    
            $data  = [
                'SQLSupplier'   => $sql_supp->paginate($jml_limit),
                'Pagination'    => $sql_supp->pager->links('default', 'bootstrap_full'),
                'Halaman'       => (isset($_GET['page']) ? ($_GET['page'] != '1' ? ($_GET['page'] * $jml_limit) + 1 : 1) : 1),
                'MenuAktif'     => 'active',
                'MenuOpen'      => 'menu-open',
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath . '/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath . '/manajemen/laporan/menu_kiri',
                'konten'        => $this->ThemePath . '/manajemen/laporan/data_supplier',
            ];
            
            return view($this->ThemePath.'/index', $data); 
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }

    // EXPORT EXCEL

    /**
     * Export sales data to Excel
     * 
     * @author mike
     * @date 2024-03-13
     */
    public function export_penjualan()
    {
        if ($this->ionAuth->loggedIn()) {
            // Get filter parameters
            $kode       = $this->request->getVar('filter_kode');
            $nama       = $this->request->getVar('filter_nama');
            $sales      = $this->request->getVar('filter_sales');
            $status     = $this->request->getVar('status');
            $tgl_rentang = $this->request->getVar('filter_tgl_rentang');

            // Initialize models
            $trPenj = new \App\Models\trPenj();

            // Build query with filters
            $sql_penj = $trPenj->asObject()
                ->select('tbl_trans_jual.*, tbl_m_pelanggan.nama as p_nama, tbl_m_pelanggan.alamat as p_alamat')
                ->join('tbl_m_pelanggan', 'tbl_m_pelanggan.id = tbl_trans_jual.id_pelanggan', 'left')
                ->orderBy('tbl_trans_jual.id', 'DESC');

            // Apply filters if they exist
            if (!empty($kode)) {
                $sql_penj->groupStart()
                    ->like('tbl_trans_jual.no_nota', $kode)
                    ->orLike('tbl_trans_jual.no_kontrak', $kode)
                    ->orLike('tbl_trans_jual.no_paket', $kode)
                    ->groupEnd();
            }

            if (!empty($nama)) {
                $sql_penj->like('tbl_m_pelanggan.nama', $nama);
            }

            if (!empty($sales)) {
                $sql_penj->where('tbl_trans_jual.id_sales', $sales);
            }

            if (!empty($status)) {
                $sql_penj->where('tbl_trans_jual.status', $status);
            }

            // Handle date range filter
            if (!empty($tgl_rentang)) {
                $dates = explode(' - ', $tgl_rentang);
                if (count($dates) == 2) {
                    $start_date = tgl_indo_sys($dates[0]);
                    $end_date = tgl_indo_sys($dates[1]);
                    $sql_penj->where('tbl_trans_jual.tgl_simpan >=', $start_date)
                        ->where('tbl_trans_jual.tgl_simpan <=', $end_date);
                }
            }

            $data = $sql_penj->findAll();

            // Create Excel file
            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // Set headers
            $sheet->setCellValue('A1', 'No. Nota');
            $sheet->setCellValue('B1', 'Tanggal');
            $sheet->setCellValue('C1', 'Customer');
            $sheet->setCellValue('D1', 'Alamat');
            $sheet->setCellValue('E1', 'Total');
            $sheet->setCellValue('F1', 'Status');
            $sheet->setCellValue('G1', 'Sales');

            // Fill data
            $row = 2;
            foreach ($data as $item) {
                $sheet->setCellValue('A' . $row, $item->no_nota);
                $sheet->setCellValue('B' . $row, tgl_indo5($item->tgl_simpan));
                $sheet->setCellValue('C' . $row, $item->p_nama ?? '-');
                $sheet->setCellValue('D' . $row, $item->p_alamat ?? '-');
                $sheet->setCellValue('E' . $row, $item->jml_gtotal);
                $sheet->setCellValue('F' . $row, ($item->status == 1 ? 'Process' : 'Draft'));

                // Safely get sales user name
                $salesUser = $this->ionAuth->user($item->id_sales)->row();
                $salesName = $salesUser ? $salesUser->first_name . ' ' . $salesUser->last_name : '-';
                $sheet->setCellValue('G' . $row, $salesName);

                $row++;
            }

            // Set column widths
            $sheet->getColumnDimension('A')->setWidth(20);
            $sheet->getColumnDimension('B')->setWidth(15);
            $sheet->getColumnDimension('C')->setWidth(30);
            $sheet->getColumnDimension('D')->setWidth(40);
            $sheet->getColumnDimension('E')->setWidth(15);
            $sheet->getColumnDimension('F')->setWidth(15);
            $sheet->getColumnDimension('G')->setWidth(20);

            // Create Excel file
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            $filename = 'Laporan_Penjualan_' . date('YmdHis') . '.xlsx';

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');

            $writer->save('php://output');
            exit;
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }

    /**
     * Export purchase data to Excel
     * 
     * @author mike
     * @date 2024-03-13
     */
    public function export_pembelian()
    {
        if ($this->ionAuth->loggedIn()) {
            // Get filter parameters
            $kode        = $this->request->getVar('filter_kode');
            $nama        = $this->request->getVar('filter_nama');
            $supplier    = $this->request->getVar('filter_supplier');
            $status      = $this->request->getVar('status');
            $tgl_rentang = $this->request->getVar('filter_tgl_rentang');

            // Initialize models
            $trPembelian = new \App\Models\trPembelian();

            // Build query with filters
            $sql_pembelian = $trPembelian->asObject()
                ->select('tbl_trans_beli.*, tbl_m_supplier.nama as s_nama, tbl_m_supplier.alamat as s_alamat')
                ->join('tbl_m_supplier', 'tbl_m_supplier.id = tbl_trans_beli.id_supplier', 'left')
                ->orderBy('tbl_trans_beli.id', 'DESC');

            // Apply filters if they exist
            if (!empty($kode)) {
                $sql_pembelian->like('tbl_trans_beli.no_nota', $kode);
            }

            if (!empty($nama)) {
                $sql_pembelian->like('tbl_m_supplier.nama', $nama);
            }

            if (!empty($supplier)) {
                $sql_pembelian->where('tbl_trans_beli.id_supplier', $supplier);
            }

            if (!empty($status)) {
                $sql_pembelian->where('tbl_trans_beli.status', $status);
            }

            // Handle date range filter
            if (!empty($tgl_rentang)) {
                $dates = explode(' - ', $tgl_rentang);
                if (count($dates) == 2) {
                    $start_date = tgl_indo_sys($dates[0]);
                    $end_date = tgl_indo_sys($dates[1]);
                    $sql_pembelian->where('tbl_trans_beli.tgl_simpan >=', $start_date)
                        ->where('tbl_trans_beli.tgl_simpan <=', $end_date);
                }
            }

            $data = $sql_pembelian->findAll();

            // Create Excel file
            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // Set headers
            $sheet->setCellValue('A1', 'No. Pembelian');
            $sheet->setCellValue('B1', 'Tanggal');
            $sheet->setCellValue('C1', 'Supplier');
            $sheet->setCellValue('D1', 'Alamat');
            $sheet->setCellValue('E1', 'Total');
            $sheet->setCellValue('F1', 'Status');
            $sheet->setCellValue('G1', 'User');

            // Fill data
            $row = 2;
            foreach ($data as $item) {
                $sheet->setCellValue('A' . $row, $item->no_nota);
                $sheet->setCellValue('B' . $row, tgl_indo5($item->tgl_simpan));
                $sheet->setCellValue('C' . $row, $item->s_nama ?? '-');
                $sheet->setCellValue('D' . $row, $item->s_alamat ?? '-');
                $sheet->setCellValue('E' . $row, $item->jml_gtotal);
                $sheet->setCellValue('F' . $row, ($item->status == 1 ? 'Process' : 'Draft'));

                // Safely get user name
                $user = $this->ionAuth->user($item->id_user)->row();
                $userName = $user ? $user->first_name . ' ' . $user->last_name : '-';
                $sheet->setCellValue('G' . $row, $userName);

                $row++;
            }

            // Set column widths
            $sheet->getColumnDimension('A')->setWidth(20);
            $sheet->getColumnDimension('B')->setWidth(15);
            $sheet->getColumnDimension('C')->setWidth(30);
            $sheet->getColumnDimension('D')->setWidth(40);
            $sheet->getColumnDimension('E')->setWidth(15);
            $sheet->getColumnDimension('F')->setWidth(15);
            $sheet->getColumnDimension('G')->setWidth(20);

            // Create Excel file
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            $filename = 'Laporan_Pembelian_' . date('YmdHis') . '.xlsx';

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');

            $writer->save('php://output');
            exit;
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }

    /**
     * Export sales data to Excel
     * 
     * @author mike
     * @date 2024-03-13
     */
    public function export_modal()
    {
        if ($this->ionAuth->loggedIn()) {
            // Get filter parameters
            $kode       = $this->request->getVar('filter_kode');
            $nama       = $this->request->getVar('filter_nama');
            $sales      = $this->request->getVar('filter_sales');
            $status     = $this->request->getVar('status');
            $tgl_rentang = $this->request->getVar('filter_tgl_rentang');

            // Initialize models
            $trPenj = new \App\Models\trPenj();

            // Build query with filters
            $sql_penj = $trPenj->asObject()
                ->select('tbl_trans_jual.*, tbl_m_pelanggan.nama as p_nama, tbl_m_pelanggan.alamat as p_alamat')
                ->join('tbl_m_pelanggan', 'tbl_m_pelanggan.id = tbl_trans_jual.id_pelanggan', 'left')
                ->orderBy('tbl_trans_jual.id', 'DESC');

            // Apply filters if they exist
            if (!empty($kode)) {
                $sql_penj->groupStart()
                    ->like('tbl_trans_jual.no_nota', $kode)
                    ->orLike('tbl_trans_jual.no_kontrak', $kode)
                    ->orLike('tbl_trans_jual.no_paket', $kode)
                    ->groupEnd();
            }

            if (!empty($nama)) {
                $sql_penj->like('tbl_m_pelanggan.nama', $nama);
            }

            if (!empty($sales)) {
                $sql_penj->where('tbl_trans_jual.id_sales', $sales);
            }

            if (!empty($status)) {
                $sql_penj->where('tbl_trans_jual.status', $status);
            }

            // Handle date range filter
            if (!empty($tgl_rentang)) {
                $dates = explode(' - ', $tgl_rentang);
                if (count($dates) == 2) {
                    $start_date = tgl_indo_sys($dates[0]);
                    $end_date = tgl_indo_sys($dates[1]);
                    $sql_penj->where('tbl_trans_jual.tgl_simpan >=', $start_date)
                        ->where('tbl_trans_jual.tgl_simpan <=', $end_date);
                }
            }

            $data = $sql_penj->findAll();

            // Create Excel file
            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // Set headers
            $sheet->setCellValue('A1', 'No. Nota');
            $sheet->setCellValue('B1', 'Tanggal');
            $sheet->setCellValue('C1', 'Customer');
            $sheet->setCellValue('D1', 'Alamat');
            $sheet->setCellValue('E1', 'Modal');
            $sheet->setCellValue('F1', 'Status');
            $sheet->setCellValue('G1', 'Sales');

            // Fill data
            $row = 2;
            foreach ($data as $item) {
                $sheet->setCellValue('A' . $row, $item->no_nota);
                $sheet->setCellValue('B' . $row, tgl_indo5($item->tgl_simpan));
                $sheet->setCellValue('C' . $row, $item->p_nama ?? '-');
                $sheet->setCellValue('D' . $row, $item->p_alamat ?? '-');
                $sheet->setCellValue('E' . $row, $item->jml_hpp);
                $sheet->setCellValue('F' . $row, ($item->status == 1 ? 'Process' : 'Draft'));

                // Safely get sales user name
                $salesUser = $this->ionAuth->user($item->id_sales)->row();
                $salesName = $salesUser ? $salesUser->first_name . ' ' . $salesUser->last_name : '-';
                $sheet->setCellValue('G' . $row, $salesName);

                $row++;
            }

            // Set column widths
            $sheet->getColumnDimension('A')->setWidth(20);
            $sheet->getColumnDimension('B')->setWidth(15);
            $sheet->getColumnDimension('C')->setWidth(30);
            $sheet->getColumnDimension('D')->setWidth(40);
            $sheet->getColumnDimension('E')->setWidth(15);
            $sheet->getColumnDimension('F')->setWidth(15);
            $sheet->getColumnDimension('G')->setWidth(20);

            // Create Excel file
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            $filename = 'Laporan_Modal_' . date('YmdHis') . '.xlsx';

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');

            $writer->save('php://output');
            exit;
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }

    /**
     * Export sales data to Excel
     * 
     * @author mike
     * @date 2024-03-13
     */
    public function export_untung_rugi()
    {
        if ($this->ionAuth->loggedIn()) {
            // Get filter parameters
            $kode       = $this->request->getVar('filter_kode');
            $nama       = $this->request->getVar('filter_nama');
            $sales      = $this->request->getVar('filter_sales');
            $status     = $this->request->getVar('status');
            $profit_status = $this->input->getVar('filter_profit');
            $tgl_rentang = $this->request->getVar('filter_tgl_rentang');

            // Initialize models
            $trPenj = new \App\Models\trPenj();

            // Build query with filters
            $sql_penj = $trPenj->asObject()
                ->select('tbl_trans_jual.*, tbl_m_pelanggan.nama as p_nama, tbl_m_pelanggan.alamat as p_alamat,
                (CASE 
                    WHEN tbl_trans_jual.jml_profit >= 0 THEN "Untung" 
                    ELSE "Rugi" 
                END) AS profit_status')
                ->join('tbl_m_pelanggan', 'tbl_m_pelanggan.id = tbl_trans_jual.id_pelanggan', 'left')
                ->orderBy('tbl_trans_jual.id', 'DESC');

            // Apply filters if they exist
            if (!empty($kode)) {
                $sql_penj->groupStart()
                    ->like('tbl_trans_jual.no_nota', $kode)
                    ->orLike('tbl_trans_jual.no_kontrak', $kode)
                    ->orLike('tbl_trans_jual.no_paket', $kode)
                    ->groupEnd();
            }

            if (!empty($nama)) {
                $sql_penj->like('tbl_m_pelanggan.nama', $nama);
            }

            if (!empty($sales)) {
                $sql_penj->where('tbl_trans_jual.id_sales', $sales);
            }

            if (!empty($status)) {
                $sql_penj->where('tbl_trans_jual.status', $status);
            }

            if (!empty($profit_status)) {
                if ($profit_status == 'Untung') {
                    $sql_penj->where('tbl_trans_jual.jml_profit >=', 0);
                } elseif ($profit_status == 'Rugi') {
                    $sql_penj->where('tbl_trans_jual.jml_profit <', 0);
                }
            }

            // Handle date range filter
            if (!empty($tgl_rentang)) {
                $dates = explode(' - ', $tgl_rentang);
                if (count($dates) == 2) {
                    $start_date = tgl_indo_sys($dates[0]);
                    $end_date = tgl_indo_sys($dates[1]);
                    $sql_penj->where('tbl_trans_jual.tgl_simpan >=', $start_date)
                        ->where('tbl_trans_jual.tgl_simpan <=', $end_date);
                }
            }

            $data = $sql_penj->findAll();

            // Create Excel file
            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // Set headers
            $sheet->setCellValue('A1', 'No. Nota');
            $sheet->setCellValue('B1', 'Tanggal');
            $sheet->setCellValue('C1', 'Customer');
            $sheet->setCellValue('D1', 'Alamat');
            $sheet->setCellValue('E1', 'Total');
            $sheet->setCellValue('F1', 'Profit Status');
            $sheet->setCellValue('G1', 'Status');
            $sheet->setCellValue('H1', 'Sales');

            // Fill data
            $row = 2;
            foreach ($data as $item) {
                $sheet->setCellValue('A' . $row, $item->no_nota);
                $sheet->setCellValue('B' . $row, tgl_indo5($item->tgl_simpan));
                $sheet->setCellValue('C' . $row, $item->p_nama ?? '-');
                $sheet->setCellValue('D' . $row, $item->p_alamat ?? '-');
                $sheet->setCellValue('E' . $row, $item->jml_profit);
                $sheet->setCellValue('F' . $row, $item->profit_status);
                $sheet->setCellValue('G' . $row, ($item->status == 1 ? 'Process' : 'Draft'));

                // Safely get sales user name
                $salesUser = $this->ionAuth->user($item->id_sales)->row();
                $salesName = $salesUser ? $salesUser->first_name . ' ' . $salesUser->last_name : '-';
                $sheet->setCellValue('H' . $row, $salesName);

                $row++;
            }

            // Set column widths
            $sheet->getColumnDimension('A')->setWidth(20);
            $sheet->getColumnDimension('B')->setWidth(15);
            $sheet->getColumnDimension('C')->setWidth(30);
            $sheet->getColumnDimension('D')->setWidth(40);
            $sheet->getColumnDimension('E')->setWidth(15);
            $sheet->getColumnDimension('F')->setWidth(15);
            $sheet->getColumnDimension('G')->setWidth(15);
            $sheet->getColumnDimension('H')->setWidth(20);

            // Create Excel file
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            $filename = 'Laporan_Untung_Rugi_' . date('YmdHis') . '.xlsx';

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');

            $writer->save('php://output');
            exit;
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }

    public function export_karyawan()
    {
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();

            $nama       = $this->input->getVar('filter_nama');
            $kode       = $this->input->getVar('filter_kode');
            $hlmn       = $this->input->getVar('page');

            $Kary       = new \App\Models\mKaryawan();
            $sql_kary   = $Kary->asObject()->orderBy('id', 'DESC');
            // Apply filters if they exist
            if (!empty($kode)) {
                $sql_kary->like('kode', $kode);
            }

            if (!empty($nama)) {
                $sql_kary->like('nama', $nama);
            }
            $data = $sql_kary->findAll();

            // Create Excel file
            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // Set headers
            $sheet->setCellValue('A1', 'Kode');
            $sheet->setCellValue('B1', 'Nama');
            $sheet->setCellValue('C1', 'Alamat');

            // Fill data
            $row = 2;
            foreach ($data as $item) {
                $sheet->setCellValue('A' . $row, $item->kode);
                $sheet->setCellValue('B' . $row, $item->nama ?? '-');
                $sheet->setCellValue('C' . $row, $item->alamat ?? '-');
                $row++;
            }

            // Set column widths
            $sheet->getColumnDimension('A')->setWidth(20);
            $sheet->getColumnDimension('B')->setWidth(15);
            $sheet->getColumnDimension('C')->setWidth(40);

            // Create Excel file
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            $filename = 'Laporan_Karyawan_' . date('YmdHis') . '.xlsx';

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');

            $writer->save('php://output');
            exit;
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }

    public function export_supplier()
    {
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();

            $nama       = $this->input->getVar('filter_nama');
            $kode       = $this->input->getVar('filter_kode');
            $hlmn       = $this->input->getVar('page');

            $Supp       = new \App\Models\mSupplier();
            $sql_supp   = $Supp->asObject()->orderBy('id', 'DESC');
            // Apply filters if they exist
            if (!empty($kode)) {
                $sql_supp->like('kode', $kode);
            }

            if (!empty($nama)) {
                $sql_supp->like('nama', $nama);
            }
            $data = $sql_supp->findAll();

            // Create Excel file
            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // Set headers
            $sheet->setCellValue('A1', 'Kode');
            $sheet->setCellValue('B1', 'Nama');
            $sheet->setCellValue('C1', 'Alamat');

            // Fill data
            $row = 2;
            foreach ($data as $item) {
                $sheet->setCellValue('A' . $row, $item->kode);
                $sheet->setCellValue('B' . $row, $item->nama ?? '-');
                $sheet->setCellValue('C' . $row, $item->alamat ?? '-');
                $row++;
            }

            // Set column widths
            $sheet->getColumnDimension('A')->setWidth(20);
            $sheet->getColumnDimension('B')->setWidth(15);
            $sheet->getColumnDimension('C')->setWidth(40);

            // Create Excel file
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            $filename = 'Laporan_Supplier_' . date('YmdHis') . '.xlsx';

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');

            $writer->save('php://output');
            exit;
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }

    // EXPORET PDF
    public function export_pembelian_pdf()
    {
        // Get filter parameters
        $kode        = $this->request->getVar('filter_kode');
        $nama        = $this->request->getVar('filter_nama');
        $supplier    = $this->request->getVar('filter_supplier');
        $status      = $this->request->getVar('status');
        $tgl_rentang = $this->request->getVar('filter_tgl_rentang');

        // Initialize models
        $trPembelian = new \App\Models\trPembelian();

        // Build query with filters
        $sql_pembelian = $trPembelian->asObject()
            ->select('tbl_trans_beli.*, tbl_m_supplier.nama as s_nama, tbl_m_supplier.alamat as s_alamat')
            ->join('tbl_m_supplier', 'tbl_m_supplier.id = tbl_trans_beli.id_supplier', 'left')
            ->orderBy('tbl_trans_beli.id', 'DESC');

        // Apply filters if they exist
        if (!empty($kode)) {
            $sql_pembelian->like('tbl_trans_beli.no_nota', $kode);
        }

        if (!empty($nama)) {
            $sql_pembelian->like('tbl_m_supplier.nama', $nama);
        }

        if (!empty($supplier)) {
            $sql_pembelian->where('tbl_trans_beli.id_supplier', $supplier);
        }

        if (!empty($status)) {
            $sql_pembelian->where('tbl_trans_beli.status', $status);
        }

        // Handle date range filter
        if (!empty($tgl_rentang)) {
            $dates = explode(' - ', $tgl_rentang);
            if (count($dates) == 2) {
                $start_date = tgl_indo_sys($dates[0]);
                $end_date = tgl_indo_sys($dates[1]);
                $sql_pembelian->where('tbl_trans_beli.tgl_simpan >=', $start_date)
                    ->where('tbl_trans_beli.tgl_simpan <=', $end_date);
            }
        }

        $data = $sql_pembelian->findAll();
        // Load Dompdf
        $dompdf = new  \Dompdf\Dompdf();
        $options = new \Dompdf\Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf->setOptions($options);

        // Buat HTML untuk laporan PDF
        $html = view('/manajemen/laporan/pdf/data_pembelian_pdf', [
            'SQLPembelian' => $data
        ]);

        // Load HTML ke Dompdf
        $dompdf->loadHtml($html);

        // Render PDF (secara internal)
        $dompdf->render();

        // Output file PDF ke browser
        $dompdf->stream("laporan_pembelian.pdf", array("Attachment" => 0));
    }
}
