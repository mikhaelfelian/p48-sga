<?php
namespace App\Controllers;

/**
 * Description of Manajemen
 *
 * @author mike
 */
class Manajemen extends BaseController {

    public function __construct() {
        
    }
    
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
                'menu_kiri'     => $this->ThemePath.'/manajemen/menu_kiri',
                'konten'        => $this->ThemePath.'/manajemen/konten',
            ];
            
            return view($this->ThemePath.'/index', $data);           
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
}
