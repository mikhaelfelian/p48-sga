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
            $Profile = new \App\Models\PengaturanProfile();
            $sql_profile = $Profile->asObject()->where('status', '1')->find();

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
            
            // Set pagination limit
            $jml_limit = $this->Setting->jml_item;

            $data = [
                'SQLPenjualan'  => $sql_penj->paginate($jml_limit),
                'SQLUsers'      => $this->ionAuth->users('sales')->result(),
                'SQLProfile'    => $sql_profile,
                'Pagination'    => $trPenj->pager->links(),
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
            $hlmn = $this->input->getVar('page');

            $trPembelian = new \App\Models\trPembelian();
            $Profile = new \App\Models\PengaturanProfile();
            $sql_profile = $Profile->asObject()
                ->where('status', '1')
                ->find();

            // Build query with proper joins and field selection
            $sql_pembelian = $trPembelian->asObject()
                ->select('tbl_trans_beli.*, tbl_m_supplier.nama as supplier, tbl_m_supplier.alamat')
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
            
            $jml_limit = $this->Setting->jml_item;

            $data = [
                'SQLPembelian'  => $sql_pembelian->paginate($jml_limit),
                'SQLSupplier'   => $this->ionAuth->users('supplier')->result(),
                'SQLProfile'    => $sql_profile,
                'Pagination'    => $trPembelian->pager->links(),
                'Halaman'       => (isset($_GET['page']) ? ($_GET['page'] != '1' ? ($_GET['page'] * $jml_limit) + 1 : 1) : 1),
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath . '/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath . '/manajemen/laporan/menu_kiri',
                'konten'        => $this->ThemePath . '/manajemen/laporan/data_pembelian',
            ];

            return view($this->ThemePath . '/index', $data);
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
    public function export_penjualan()
    {
        if ($this->ionAuth->loggedIn()) {
            // Get filter parameters
            $kode       = $this->input->getVar('filter_kode');
            $nama       = $this->input->getVar('filter_nama');
            $sales      = $this->input->getVar('filter_sales');
            $status     = $this->input->getVar('status');
            $tgl_rentang = $this->input->getVar('filter_tgl_rentang');

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
                $sheet->setCellValue('C' . $row, $item->p_nama);
                $sheet->setCellValue('D' . $row, $item->p_alamat);
                $sheet->setCellValue('E' . $row, $item->jml_gtotal);
                $sheet->setCellValue('F' . $row, status_penj($item->status));
                $sheet->setCellValue('G' . $row, $this->ionAuth->user($item->id_sales)->row()->first_name);
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
                $sheet->setCellValue('C' . $row, $item->supplier);
                $sheet->setCellValue('D' . $row, $item->alamat);
                $sheet->setCellValue('E' . $row, $item->jml_gtotal);
                $sheet->setCellValue('F' . $row, status_penj($item->status));
                $sheet->setCellValue('G' . $row, $this->ionAuth->user($item->id_user)->row()->username);
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
}
