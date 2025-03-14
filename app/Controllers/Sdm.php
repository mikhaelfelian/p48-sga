<?php

namespace App\Controllers;

use App\Models\PengaturanProfile;

/**
 * Description of SDM (Sumber Daya Manusia)
 *
 * @author mike
 */
class Sdm extends BaseController
{
    //put your code here
    public function __construct()
    {

    }

    public function index()
    {
        if ($this->ionAuth->loggedIn()) {
            $ID = $this->ionAuth->user()->row();
            $IDGrup = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup = $this->ionAuth->groups()->result();

            $nama = $this->request->getVar('filter_nama');
            $hlmn = $this->request->getVar('page');

            $Karyawan = new \App\Models\mKaryawan();
            $sql_kary = $Karyawan->asObject()->orderBy('id', 'DESC')->like('nama', (!empty($nama) ? $nama : ''));
            $jml_limit = $this->Setting->jml_item;

            $data = [
                'SQLKaryawan' => $sql_kary->paginate($jml_limit),
                'Pagination' => $Karyawan->pager->links(),
                'Halaman' => (isset($_GET['page']) ? ($_GET['page'] != '1' ? ($_GET['page'] * $jml_limit) + 1 : 1) : 1),
                'MenuAktif' => 'active',
                'MenuOpen' => 'menu-open',
                'AksesGrup' => $AksesGrup,
                'Pengguna' => $ID,
                'PenggunaGrup' => $IDGrup,
                'Pengaturan' => $this->Setting,
                'ThemePath' => $this->ThemePath,
                'menu_atas' => $this->ThemePath . '/layout/menu_atas',
                'menu_kiri' => $this->ThemePath . '/manajemen/sdm/menu_kiri',
                'konten' => $this->ThemePath . '/manajemen/sdm/konten',
            ];

            return view($this->ThemePath . '/index', $data);
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }

    /**
     * Display employee data list
     * 
     * This function retrieves all employee data from the mKaryawan model
     * and displays it in a table view.
     * 
     * @return \CodeIgniter\HTTP\RedirectResponse|string
     * 
     * @author Mikhael Felian Waskito - mikhaelfelian@gmail.com
     * @date 2025-03-13
     */
    public function data_karyawan()
    {
        if ($this->ionAuth->loggedIn()) {
            $ID = $this->ionAuth->user()->row();
            $IDGrup = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup = $this->ionAuth->groups()->result();

            $nama = $this->request->getVar('filter_nama');
            $hlmn = $this->request->getVar('page');

            // Initialize the mKaryawan model
            $Karyawan = new \App\Models\mKaryawan();
            $sql_kary = $Karyawan->asObject()->orderBy('id', 'DESC')->like('nama', (!empty($nama) ? $nama : ''));
            $jml_limit = $this->Setting->jml_item;

            $data = [
                'SQLKaryawan' => $sql_kary->paginate($jml_limit),
                'Pagination' => $Karyawan->pager->links(),
                'Halaman' => (isset($_GET['page']) ? ($_GET['page'] != '1' ? ($_GET['page'] * $jml_limit) + 1 : 1) : 1),
                'MenuAktif' => 'active',
                'MenuOpen' => 'menu-open',
                'AksesGrup' => $AksesGrup,
                'Pengguna' => $ID,
                'PenggunaGrup' => $IDGrup,
                'Pengaturan' => $this->Setting,
                'ThemePath' => $this->ThemePath,
                'menu_atas' => $this->ThemePath . '/layout/menu_atas',
                'menu_kiri' => $this->ThemePath . '/manajemen/sdm/menu_kiri',
                'konten' => $this->ThemePath . '/manajemen/sdm/data_karyawan',
            ];

            return view($this->ThemePath . '/index', $data);
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }

    /**
     * Display employee leave/time-off data
     * 
     * This function retrieves all employee leave requests from the trSdmCuti model
     * and displays them in a table view.
     * 
     * @return \CodeIgniter\HTTP\RedirectResponse|string
     * 
     * @author Mikhael Felian Waskito - mikhaelfelian@gmail.com
     * @date 2025-03-14
     */
    public function data_cuti()
    {
        if ($this->ionAuth->loggedIn()) {
            $ID = $this->ionAuth->user()->row();
            $IDGrup = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup = $this->ionAuth->groups()->result();

            // Get filter parameters
            $nama = $this->request->getVar('filter_nama');
            $status = $this->request->getVar('filter_status');
            $hlmn = $this->request->getVar('page');

            // Initialize the trSdmCuti model
            $Cuti = new \App\Models\trSdmCuti();

            // Get employee model for employee names
            $Karyawan = new \App\Models\mKaryawan();

            // Prepare filters
            $filters = [];
            if (!empty($status) && $status != '-') {
                $filters['status'] = $status;
            }

            // Get cuti data with details
            $sql_cuti = $Cuti->getCutiWithDetails($filters);

            // If name filter is applied, filter results
            if (!empty($nama)) {
                $filtered_cuti = [];
                foreach ($sql_cuti as $cuti) {
                    if (stripos($cuti['nama_karyawan'], $nama) !== false) {
                        $filtered_cuti[] = $cuti;
                    }
                }
                $sql_cuti = $filtered_cuti;
            }

            // Pagination setup
            $jml_limit = $this->Setting->jml_item;
            $total_rows = count($sql_cuti);
            $total_pages = ceil($total_rows / $jml_limit);
            $current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
            $offset = ($current_page - 1) * $jml_limit;

            // Slice the data for pagination
            $sql_cuti = array_slice($sql_cuti, $offset, $jml_limit);

            $data = [
                'SQLCuti' => $sql_cuti,
                'Halaman' => (isset($_GET['page']) ? ($_GET['page'] != '1' ? (($_GET['page'] - 1) * $jml_limit) + 1 : 1) : 1),
                'TotalPages' => $total_pages,
                'CurrentPage' => $current_page,
                'MenuAktif' => 'active',
                'MenuOpen' => 'menu-open',
                'AksesGrup' => $AksesGrup,
                'Pengguna' => $ID,
                'PenggunaGrup' => $IDGrup,
                'Pengaturan' => $this->Setting,
                'ThemePath' => $this->ThemePath,
                'menu_atas' => $this->ThemePath . '/layout/menu_atas',
                'menu_kiri' => $this->ThemePath . '/manajemen/sdm/menu_kiri',
                'konten' => $this->ThemePath . '/manajemen/sdm/cuti/data_cuti',
            ];

            return view($this->ThemePath . '/index', $data);
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
}