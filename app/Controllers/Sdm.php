<?php

namespace App\Controllers;

use App\Models\PengaturanProfile;

/**
 * Description of SDM (Sumber Daya Manusia)
 *
 * @author mike
 */
class Sdm extends BaseController {
    //put your code here
    public function __construct() {
        
    }

    public function index() {
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();

            $nama       = $this->input->getVar('filter_nama');
            $hlmn       = $this->input->getVar('page');

            $Karyawan   = new \App\Models\mKaryawan();
            $sql_kary   = $Karyawan->asObject()->orderBy('id', 'DESC')->like('nama', (!empty($nama) ? $nama : ''));
            $jml_limit  = $this->Setting->jml_item;
                                    
            $data  = [
                'SQLKaryawan'   => $sql_kary->paginate($jml_limit),
                'Pagination'    => $Karyawan->pager->links(),
                'Halaman'       => (isset($_GET['page']) ? ($_GET['page'] != '1' ? ($_GET['page'] * $jml_limit) + 1 : 1) : 1),
                'MenuAktif'     => 'active',
                'MenuOpen'      => 'menu-open',
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/sdm/menu_kiri',
                'konten'        => $this->ThemePath.'/manajemen/sdm/konten',
            ];
            
            return view($this->ThemePath.'/index', $data);           
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
} 