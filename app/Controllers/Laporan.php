<?php
namespace App\Controllers;

/**
 * Description of Laporan
 *
 * @author mike
 */
class Laporan extends BaseController {
    
    public function index(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
                        
            $data  = [
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/laporan/menu_kiri',
                'konten'        => $this->ThemePath.'/manajemen/laporan/konten',
            ];
            
            return view($this->ThemePath.'/index', $data);           
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function data_rab(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $kode       = $this->input->getVar('filter_kode');
            $nama       = $this->input->getVar('filter_nama');
            $tipe       = $this->input->getVar('filter_tipe');
            $status     = $this->input->getVar('status');
            $hlmn       = $this->input->getVar('page');

            $Tipe           = new \App\Models\mTipe();
            $vtrRab         = new \App\Models\vtrRab();
            $Profile        = new \App\Models\PengaturanProfile();            
            $sql_profile    = $Profile->asObject()->where('status', '1')->find();
            
            $sql_rab        = $vtrRab->asObject()->orderBy('id', 'DESC')->like('no_rab', (!empty($kode) ? $kode : ''))->like('p_nama', (!empty($nama) ? $nama : ''))->like('id_tipe', (!empty($tipe) ? $tipe : ''), (!empty($tipe) ? 'none' : ''))->like('status', (!empty($status) ? $status : ''), (!empty($status) ? 'none' : ''));
            $sql_tipe       = $Tipe->asObject()->where('status', '1')->find(); //->like('kode', (!empty($kode) ? $kode : ''))->like('kategori', (!empty($kat) ? $kat : ''));
            $jml_limit      = $this->Setting->jml_item;
            
            $data  = [
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
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/laporan/menu_kiri',
                'konten'        => $this->ThemePath.'/manajemen/laporan/data_rab',
            ];
            
            return view($this->ThemePath.'/index', $data);           
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
}
